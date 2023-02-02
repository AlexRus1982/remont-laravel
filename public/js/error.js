class ErrorScript {

    constructor(){
        console.log(this.constructor.name);

        setTimeout(()=>{
            self.location = "/";
        }, 3000);
    }

}

new ErrorScript();