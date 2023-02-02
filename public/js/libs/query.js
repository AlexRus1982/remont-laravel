export class Query {

    _MakeRequest(requestMethod, url, dataParams){
        return new Request(url, {
            method: requestMethod,
            body: JSON.stringify(dataParams),
            headers: new Headers({
                'Content-Type': 'application/json; charset=UTF-8', // отошлет только input данные
                // 'Content-Type': 'application/x-www-form-urlencoded', // отошлет и в input, и в $_POST данные
            })
        });    
    }

    _MakeQueryJSON(request, onDone = null){
        fetch(request)
            .then(data => data.json())
            .then((jsonData) => {
                // console.log('request succeeded with TEXT response', jsonData);
                if (onDone != null) onDone(jsonData);
            }).catch(function (error) {
                console.log('request failed', error)
                if (onDone != null) onDone('');
            });
    }

    _MakeQuery(request, onDone = null){
        fetch(request)
            .then(data => data.text())
            .then((data) => {
                // console.log('request succeeded with JSON response', data);
                if (onDone != null) onDone(data);
            }).catch(function (error) {
                console.log('request failed', error)
            });
    }    

    Get(url, params, onDone = null, jsonResult = true){
        // params = { "param1": "value1", "param2": "value2" };

        let query = Object.keys(params)
            .map(k => encodeURIComponent(k) + '=' + encodeURIComponent(params[k]))
            .join('&');

        let request = url + ((query != '') ? '?' : '') + query;

        (jsonResult) ? this._MakeQueryJSON(request, onDone) : this._MakeQuery(request, onDone);
    }

    Post(url, dataParams, onDone = null, jsonResult = true){
        let request = this._MakeRequest('POST', url, dataParams);
        (jsonResult) ? this._MakeQueryJSON(request, onDone) : this._MakeQuery(request, onDone);
    }

    Put(url, dataParams, onDone = null, jsonResult = true){
        let request = this._MakeRequest('PUT', url, dataParams);
        (jsonResult) ? this._MakeQueryJSON(request, onDone) : this._MakeQuery(request, onDone);
    }

    Delete(url, dataParams, onDone = null, jsonResult = true){
        let request = this._MakeRequest('DELETE', url, dataParams);
        (jsonResult) ? this._MakeQueryJSON(request, onDone) : this._MakeQuery(request, onDone);
    }

}