export class ComponentsManager {
  static _htmlComponents = new Map();
  static _cssComponents = new Map();
  static _jsComponents = new Map();

  static getFromBetween = {
    results:[],
    string:"",
    getFromBetween:function (sub1,sub2) {
        if(this.string.indexOf(sub1) < 0 || this.string.indexOf(sub2) < 0) return false;
        var SP = this.string.indexOf(sub1)+sub1.length;
        var string1 = this.string.substr(0,SP);
        var string2 = this.string.substr(SP);
        var TP = string1.length + string2.indexOf(sub2);
        return this.string.substring(SP,TP);
    },
    removeFromBetween:function (sub1,sub2) {
        if(this.string.indexOf(sub1) < 0 || this.string.indexOf(sub2) < 0) return false;
        var removal = sub1+this.getFromBetween(sub1,sub2)+sub2;
        this.string = this.string.replace(removal,"");
    },
    getAllResults:function (sub1,sub2) {
        // first check to see if we do have both substrings
        if(this.string.indexOf(sub1) < 0 || this.string.indexOf(sub2) < 0) return;

        // find one result
        var result = this.getFromBetween(sub1,sub2);
        // push it to the results array
        this.results.push(result);
        // remove the most recently found one from the string
        this.removeFromBetween(sub1,sub2);

        // if there's more substrings
        if(this.string.indexOf(sub1) > -1 && this.string.indexOf(sub2) > -1) {
            this.getAllResults(sub1,sub2);
        }
        else return;
    },
    get:function (string,sub1,sub2) {
        this.results = [];
        this.string = string;
        this.getAllResults(sub1,sub2);
        return this.results;
    }
  };

  //#region utils section -----------------------------------------------
  static _UrlExists(url) {
    try {
      let http = new XMLHttpRequest();
      http.open("HEAD", url, false);
      http.send();
      return http.status != 404;
    } catch {}
    return false;
  }

  static _MakeQuery(request, onDone = null) {
    fetch(request)
      .then((data) => data.text())
      .then((data) => {
        // console.log('request succeeded with JSON response', jsonData);
        if (onDone != null) onDone(data);
      })
      .catch(function (error) {
        console.log("request failed", error);
      });
  }

  static GetSyncHTML(pathHTML) {
    return $.ajax({
      type: "GET",
      url: pathHTML,
      cache: false,
      async: false,
    }).responseText;
  }

  //#endregion utils section --------------------------------------------
  static MakePageComponents() {
    $("component").each(function () {
      let componentName = $(this).attr("name");
      let props = $(this).attr("props");
      eval(`props = ${props}`);
      // console.log(props);
      
      let loadhtml = $(this).attr("loadhtml");
      let loadcss = $(this).attr("loadcss");
      let loadjs = $(this).attr("loadjs");

      let options = {
        optHtml: (loadhtml != undefined && loadhtml != false) ? loadhtml.toLowerCase() == 'true' : true,
        optCss: (loadcss != undefined && loadcss != false) ? loadcss.toLowerCase() == 'true' : true,
        optJs: (loadjs != undefined && loadjs != false) ? loadjs.toLowerCase() == 'true' : false,
      }

    //   console.log(componentName, options);
      $(this).replaceWith(ComponentsManager.LoadComponent(componentName, options, props));
    });
  }

  static GetHtmlComponent(componentName, props = {}) {
    let htmlPath = `/components/${componentName}.html`;
    return this.GetHtmlComponentFromPath(htmlPath, props);
  }

  static GetHtmlComponentFromPath(htmlPath, props = {}) {
    let htmlComponent = null;

    if (ComponentsManager._htmlComponents.has(htmlPath)) {
      htmlComponent = ComponentsManager._htmlComponents.get(htmlPath);
      // console.log('Html component already loaded!!!');
    } else {
      htmlComponent = ComponentsManager.GetSyncHTML(htmlPath);
      ComponentsManager._htmlComponents.set(htmlPath, htmlComponent);
      // console.log('Html component loaded.');
    }

    let listOfVars = ComponentsManager.getFromBetween.get(htmlComponent, "${", "}");
    // console.log(props)
    for (let item of listOfVars){
      let oldStr = "${" + item + "}";
      let newStr = `${props[item]}`;
      //console.log(item, props[item], oldStr, newStr);
      htmlComponent = htmlComponent.replaceAll(oldStr, newStr);
    }

    return htmlComponent;
  }

  static GetCssComponent(componentName) {
    let cssPath = `/components/${componentName}/${componentName}.css`;
    this.GetCssComponentFromPath(cssPath);
  }

  static GetCssComponentFromPath(cssPath) {
    let cssComponent = null;

    if (ComponentsManager._cssComponents.has(cssPath)) {
      cssComponent = ComponentsManager._cssComponents.get(cssPath);
      // console.log('CSS component already loaded!!!', cssPath);
    } else {
      let onDone = () => {
        cssComponent = $().add(
          `<link rel="stylesheet" type="text/css" href="${cssPath}" />`
        );
        if ($(`link[href="${cssPath}"]`).length == 0) {
          $("head").append(cssComponent);
        }
        ComponentsManager._cssComponents.set(cssPath, cssComponent);
        // console.log('CSS component loaded.', cssPath);
      };
      if (ComponentsManager._UrlExists(cssPath)) {
        onDone();
      }
    }
  }

  static GetJsComponent(componentName) {
    let jsPath = `/components/${componentName}/${componentName}.js`;
    this.GetJsComponentFromPath(jsPath);
  }

  static GetJsComponentFromPath(jsPath) {
    let jsComponent = null;

    if (ComponentsManager._jsComponents.has(jsPath)) {
      jsComponent = ComponentsManager._jsComponents.get(jsPath);
      // console.log('JS component already loaded!!!');
    } else {
      let onDone = () => {
        jsComponent = $().add(
          `<script type="module" src="${jsPath}"></script>`
        );
        if ($(`script[src="${jsPath}"]`).length == 0) {
          $("body").append(jsComponent);
        }
        ComponentsManager._jsComponents.set(jsPath, jsComponent);
        // console.log('JS component loaded.');
      };
      if (ComponentsManager._UrlExists(jsPath)) {
        onDone();
      }
    }
  }

  static LoadComponent(
    componentName,
    options = { optHtml: true, optCss: true, optJs: false },
    props = {}
  ) {
    let { optHtml, optCss, optJs } = options;

    let component = $();
    if (optCss) ComponentsManager.GetCssComponent(componentName);
    if (optHtml) component = ComponentsManager.GetHtmlComponent(componentName, props);
    if (optJs) ComponentsManager.GetJsComponent(componentName);
    return component;
  }
}