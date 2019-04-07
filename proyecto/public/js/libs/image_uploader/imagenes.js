var ImageUtil = {

    lastInputId : 0,
    lastImgId : 0,
    imagesId : [],
    imageUrls : [],
    uploadHandler : null,
    fileContainer : "",
    max : null,

    createInputfile : function (inputContainer, fileContainer, multiple, accepts, max = 10) {

        this.fileContainer = fileContainer;
        this.max = max;

        var parent = document.getElementById(inputContainer);
        var elem = document.createElement('input');
        elem.type = 'file';
        elem.id = 'img' + this.lastInputId;
        if(multiple) elem.multiple = 'multiple';

        // arrays of files types allowed
        elem.accept = accepts;
        elem.name = 'img' + this.lastInputId;

        parent.appendChild(elem);

        elem.addEventListener('change', ImageUtil.handleFileSelection, false);

        elem.click();

        this.lastInputId++;
    },

    handleFileSelection : function (e) {

        var selDiv = document.querySelector("#" + ImageUtil.fileContainer);
        selDiv.innerHTML = '';

        if(!e.target.files || !window.FileReader) return;

        var files = e.target.files;
        var filesArr = Array.prototype.slice.call(files);

        if( filesArr.count > this.max ){
            setMensaje( 'Solo se permite un maximo de ' + this.max + ' archivos' );
            return;
        }

        filesArr.forEach(function(f) {

            if(!f.type.match("image.*")) {
                return;
            }

            var reader = new FileReader();

            reader.onload = function (e) {

                var html = "<img id=\"img_" + ImageUtil.lastImgId + "\" src=\"" + e.target.result + "\" class=\"img_preview img-thumbnail\" onclick=\"ImageUtil.removeImageFromArray(this.id)\">";
                selDiv.innerHTML = html + selDiv.innerHTML;
                ImageUtil.imagesId.push("img_" + ImageUtil.lastImgId);
                ImageUtil.lastImgId++;
            };

            reader.readAsDataURL(f);
        });
    },

    removeImageFromArray : function (index) {

        var idx = this.imagesId.indexOf(index);
        this.lastImgId=this.lastImgId-1;
        if(idx != -1) {
            this.imagesId.splice(idx, 1);
        }
        $("#" + index).remove();
        console.log(this.lastImgId);

    },

    setUploadHandler : function(handler){
        this.uploadHandler = handler;
    },

    // url = URL del controlador
    sendImagesToServer : function (url, index, id) {
        //En caso que no haya imagenes para subir, llamar directo al uploadHandler y retornar
        if(this.imagesId.length <= 0){
            this.uploadHandler();
            return;
        }

        console.log("sending image(" + ImageUtil.imagesId[index] + ") to server...");
        $.post(
            url,
            {
                data: $("#" + ImageUtil.imagesId[index]).attr('src'),
                idx: index,
                regid: id
            },
            function (response) {

                try {
                    let resp = $.parseJSON(response);

                    if (resp.status === RequestStatus.OK) {

                        ImageUtil.imageUrls.push(resp.response);
                        if ((ImageUtil.imagesId.length - 1) > index) {
                            ImageUtil.sendImagesToServer(url, index + 1, id);

                        } else {
                            ImageUtil.uploadHandler();
                        }
                    } else {
                        console.log(resp);
                    }
                } catch (err) {
                    console.log(err);
                }
            }
        );
    }
};