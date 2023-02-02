export class Messages {
    
    constructor(){
    }
    
    MakeMessage(type, message, autohide = true, messageId = new Date().getTime()) {
        const messageComponent = componentsManager.GetHtmlComponent(`${type}`, {
            autohide  : autohide,
            messageId : `tost-${messageId}`,
            message   : `${message}`, 
        });
        $('.toast-container').append(messageComponent);

        const toast = new bootstrap.Toast($(`#tost-${messageId}`)[0]);
        toast.show()
    }

    Simple(message, autohide = true) {
        this.MakeMessage('simple_message', message, autohide);
    }

    Success(message, autohide = true) {
        this.MakeMessage('success_message', message, autohide);
    }

    Danger(message, autohide = true) {
        this.MakeMessage('danger_message', message, autohide);
    }

    Info(message, autohide = true) {
        this.MakeMessage('info_message', message, autohide);
    }    

    Loading(message, id) {
        this.MakeMessage('loading_message', message, false, id);
    }

}