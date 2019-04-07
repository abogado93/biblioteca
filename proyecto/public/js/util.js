const ROOT_FOLDER = '/proyecto_test/';

const RequestStatus = {
    OK : 'OK',
    SESSION_EXPIRED : 'SESSION_EXPIRED',
    NOT_AUTHORIZED : 'NOT_AUTHORIZED',
    BAD_REQUEST : 'BAD_REQUEST',
    DATABASE_ERROR : 'DATABASE_ERROR',
    FOREIGN_KEY_VIOLATION : 'FOREIGN_KEY_VIOLATION',
    DUPLICATE_KEY : 'DUPLICATE_KEY',
    KEY_NOT_FOUND : 'KEY_NOT_FOUND'

};

//función trim
function trim (s) {
    return s.replace(/^\s+/g,'').replace(/\s+$/g,'');
}

//Limpia el elemento cuyo ID = error
function clearErrorContent() {
    $("#error").html("&nbsp;");
}

//Reinicia el estado del botón
function resetButton(button) {
    setTimeout(function(){ $("#" + button).button('reset'); }, 100);
}

function setButtonText(buttonId, text) {
    setTimeout(function(){$("#" + buttonId).html(text);}, 100);
}

// Habilita o deshabilita un botón dado un ID
function changeControlState(t_id, state) {
    (state == 'disabled') ?
        $("#" + t_id).attr('disabled', state)
        :
        $("#" + t_id).removeAttr('disabled');
}

// Genera un identificador unico universal
function generateUUID() {
    var s = [];

    var hexDigits = "0123456789abcdef";

    for (var i = 0; i < 36; i++) {
        s[i] = hexDigits.substr(Math.floor(Math.random() * 0x10), 1);
    }

    s[14] = "4";  // bits 12-15 of the time_hi_and_version field to 0010
    s[19] = hexDigits.substr((s[19] & 0x3) | 0x8, 1);  // bits 6-7 of the clock_seq_hi_and_reserved to 01
    s[8] = s[13] = s[18] = s[23] = "-";

    return s.join("");
}

// Padleft prototipo
Number.prototype.padLeft = function(base,chr){
    var  len = (String(base || 10).length - String(this).length)+1;
    return len > 0 ? new Array(len).join(chr || '0') + this : this;
}

// Devuelve el timestamp actual
function getCurrentDateTime() {
    var d = new Date,
        dformat = [ d.getFullYear(),
                (d.getMonth()+1).padLeft(),
                d.getDate().padLeft()].join('-')+
            ' ' +
            [ d.getHours().padLeft(),
                d.getMinutes().padLeft(),
                d.getSeconds().padLeft()].join(':');
    return dformat;
}

function updateURL(newUrl) {

    console.log("new url: %", newUrl);

    console.log("pathname: %", window.location.pathname);

    if(window.location.pathname != newUrl) {
        window.history.pushState("data","Title", newUrl);
        document.title = newUrl;
    }
}

function numberFormat(num){
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")
}

function redirect(url) {

    window.location = 'http://localhost' + url;
}

var DateUtil = {
    toUTC : function(fecha){
        //segun formato ISO8601, retorna siempre la hora en UTC
        let month = this.addPadding( fecha.getUTCMonth() + 1 );
        let day = this.addPadding( fecha.getUTCDate() );
        let hours = this.addPadding( fecha.getUTCHours() );
        let seconds = this.addPadding( fecha.getUTCSeconds() );

        let fechaString = fecha.getUTCFullYear().toString() + month + day + 'T' + hours + seconds;
        return fechaString;
    },
    addPadding : function(number){
        return ( '0' + number.toString() ).slice(-2);
    }
}