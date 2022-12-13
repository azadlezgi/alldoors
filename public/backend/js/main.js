$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('.container-fluid .col-my-lg-4 .gutter-b .images-post-container').prepend(`
<div class="custom-preloader-container">
    <div class="custom-preloader-loader"></div>
</div>
`);

$(function (){
    $('.container-fluid .col-my-lg-4 .gutter-b .images-post-container').find('.custom-preloader-container').hide();
    $('.container-fluid .col-my-lg-4 .gutter-b .images-post-container .images-post-item').show();
})

/*   Alert Toastr START  */
toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": false,
    "positionClass": "toast-bottom-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
};
/*   Alert Toastr END  */


/*   POST THUMB IMAGE START   */
let imagePostWidth = $(".images-post-container").width();
let getWindowWidth = $(window).width();
if (getWindowWidth <= 1200 && getWindowWidth >= 575) {
    $('.images-post-item').css({'width': imagePostWidth / 1.8, 'height': imagePostWidth / 1.8});
    $('.activeButton').css({'width': imagePostWidth / 1.8, 'height': imagePostWidth / 1.8});
    $('.images-post-container figure img').css({'width': imagePostWidth / 1.8, 'height': imagePostWidth / 1.8});
    $('.imageLoad').show();
} else {
    $('.images-post-item').css({'width': imagePostWidth, 'height': imagePostWidth});
    $('.activeButton').css({'width': imagePostWidth, 'height': imagePostWidth});
    $('.images-post-container figure img').css({'width': imagePostWidth, 'height': imagePostWidth});
    $('.imageLoad').show();
}


$(window).resize(function () {
    imagePostWidth = $(".images-post-container").width();
    getWindowWidth = $(window).width();
    if (getWindowWidth <= 1200 && getWindowWidth >= 575) {
        $('.images-post-item').css({'width': imagePostWidth / 1.8, 'height': imagePostWidth / 1.8});
        $('.activeButton').css({'width': imagePostWidth / 1.8, 'height': imagePostWidth / 1.8});
        $('.images-post-container figure img').css({'width': imagePostWidth / 1.8, 'height': imagePostWidth / 1.8});
    } else {
        $('.images-post-item').css({'width': imagePostWidth, 'height': imagePostWidth});
        $('.activeButton').css({'width': imagePostWidth, 'height': imagePostWidth});
        $('.images-post-container figure img').css({'width': imagePostWidth, 'height': imagePostWidth});
    }


});

$(document).on('click', '.brand-toggle', function () {
    if (getWindowWidth <= 1200 && getWindowWidth >= 575) {
        $('.images-post-item').css({'width': imagePostWidth / 1.8, 'height': imagePostWidth / 1.8});
        $('.activeButton').css({'width': imagePostWidth / 1.8, 'height': imagePostWidth / 1.8});
        $('.images-post-container figure img').css({'width': imagePostWidth / 1.8, 'height': imagePostWidth / 1.8});
    } else {
        $('.images-post-item').css({'width': imagePostWidth, 'height': imagePostWidth});
        $('.activeButton').css({'width': imagePostWidth, 'height': imagePostWidth});
        $('.images-post-container figure img').css({'width': imagePostWidth, 'height': imagePostWidth});
    }

})

$(document).on('click', '.notPhotoPost', function () {
    const datalanguage = $(this).attr('data-languageID');
    $(this).hide();
    $('#image_label_' + datalanguage).val('');
    $('.previewImage_' + datalanguage).attr("src", noPhoto)
})

$(document).on('click', '.notPhotoPostAlone', function () {
    $(this).hide();
    $('#image_label').val('');
    $('.previewImage').attr("src", noPhoto)
})

$(document).on('click', '.notPhotoPostAloneOption', function () {
    let imgClassName = $(this).closest('.images-post-container').attr('data-class-name');
    $(this).hide();
    $('#image_label-' + imgClassName).val('');
    $('.imgClassName-' + imgClassName).attr("src", noPhoto)
})


/*   POST THUMB IMAGE END   */


/*   CKFINDER KOMEKCI BUTTON START   */

function ckfinderTinyMCEButton(x, y, fileType) {
    var fileTypes = '';

    if (fileType == 'image') {
        fileTypes = 'Images';
    }


    CKFinder.modal({
        chooseFiles: true,
        language: langaugeDefault,
        resourceType: fileTypes, //Ancaq image gosterir
        width: x * 0.8,
        height: y * 0.8,
        plugins: [
            // Path must be relative to the location of ckfinder.js file
            'samples/plugins/StatusBarInfo/StatusBarInfo'
        ],
        onInit: function (finder) {
            finder.on('files:choose', function (evt) {
                var file = evt.data.files.first();
                // var outputFileName = document.getElementById( 'file-name' );
                // var outputFileUrl = document.getElementById( 'file-url' );
                // outputFileName.innerText = 'Selected: ' + file.get( 'name' );
                // outputFileUrl.innerText = 'URL: ' + file.getUrl();

                //Inputa yaz
                $('.tox-control-wrap input').val(file.getUrl());


                // var files = evt.data.files;
                //
                // var chosenFilesName = '';
                // var chosenFilesUrl = '';
                //
                // files.forEach( function( file, i ) {
                //     chosenFilesName += ( i + 1 ) + '. ' + file.get( 'name' ) + '\n';
                //     chosenFilesUrl += ( i + 1 ) + '. ' + file.getUrl() + '\n';
                // } );
                //
                // console.log( 'AD '+chosenFilesName );
                // console.log( 'URL '+chosenFilesUrl );


            });

            finder.on('file:choose:resizedImage', function (evt) {
                // var outputFileName = document.getElementById( 'file-name' );
                // var outputFileUrl = document.getElementById( 'file-url' );
                // outputFileName.innerText = 'Selected resized image: ' + evt.data.file.get( 'name' );
                // outputFileUrl.innerText = 'URL: ' + evt.data.resizedUrl;

                //Inputa yaz
                $('.tox-control-wrap input').val(evt.data.resizedUrl);
            });


        }
    });
}

function ckfinderButton(x, y, type) {

    CKFinder.modal({
        chooseFiles: true,
        language: langaugeDefault,
        resourceType: type, //Ancaq image gosterir
        width: x * 0.8,
        height: y * 0.8,
        plugins: [
            // Path must be relative to the location of ckfinder.js file
            'samples/plugins/StatusBarInfo/StatusBarInfo'
        ],
        onInit: function (finder) {
            finder.on('files:choose', function (evt) {
                var file = evt.data.files.first();
                // var outputFileName = document.getElementById( 'file-name' );
                // var outputFileUrl = document.getElementById( 'file-url' );
                // outputFileName.innerText = 'Selected: ' + file.get( 'name' );
                // outputFileUrl.innerText = 'URL: ' + file.getUrl();

                let activeButtonCheck = $('.activeButtonCheck').attr('data-languageID');
                document.getElementById('image_label_' + activeButtonCheck).value = file.getUrl();
                document.querySelector('.previewImage_' + activeButtonCheck).src = file.getUrl();

                $('.notPhotoPost_' + activeButtonCheck).css('display', 'flex');
                $('.activeButton').removeClass('activeButtonCheck');


                // var files = evt.data.files;
                //
                // var chosenFilesName = '';
                // var chosenFilesUrl = '';
                //
                // files.forEach( function( file, i ) {
                //     chosenFilesName += ( i + 1 ) + '. ' + file.get( 'name' ) + '\n';
                //     chosenFilesUrl += ( i + 1 ) + '. ' + file.getUrl() + '\n';
                // } );
                //
                // console.log( 'AD '+chosenFilesName );
                // console.log( 'URL '+chosenFilesUrl );


            });

            finder.on('file:choose:resizedImage', function (evt) {
                // var outputFileName = document.getElementById( 'file-name' );
                // var outputFileUrl = document.getElementById( 'file-url' );
                // outputFileName.innerText = 'Selected resized image: ' + evt.data.file.get( 'name' );
                // outputFileUrl.innerText = 'URL: ' + evt.data.resizedUrl;


                let activeButtonCheck = $('.activeButtonCheck').attr('data-languageID');
                document.getElementById('image_label_' + activeButtonCheck).value = evt.data.resizedUrl;
                document.querySelector('.previewImage_' + activeButtonCheck).src = evt.data.resizedUrl;
                $('.notPhotoPost_' + activeButtonCheck).css('display', 'flex');
                $('.activeButton').removeClass('activeButtonCheck');


            });


        }
    });


}


function ckfinderAloneButton(x, y, type) {

    CKFinder.modal({
        chooseFiles: true,
        language: langaugeDefault,
        resourceType: type, //Ancaq image gosterir
        width: x * 0.8,
        height: y * 0.8,
        plugins: [
            // Path must be relative to the location of ckfinder.js file
            'samples/plugins/StatusBarInfo/StatusBarInfo'
        ],
        onInit: function (finder) {
            finder.on('files:choose', function (evt) {
                var file = evt.data.files.first();
                // var outputFileName = document.getElementById( 'file-name' );
                // var outputFileUrl = document.getElementById( 'file-url' );
                // outputFileName.innerText = 'Selected: ' + file.get( 'name' );
                // outputFileUrl.innerText = 'URL: ' + file.getUrl();


                document.getElementById('image_label').value = file.getUrl();
                document.querySelector('.previewImage').src = file.getUrl();
                $('.notPhotoPost').css('display', 'flex');


                // var files = evt.data.files;
                //
                // var chosenFilesName = '';
                // var chosenFilesUrl = '';
                //
                // files.forEach( function( file, i ) {
                //     chosenFilesName += ( i + 1 ) + '. ' + file.get( 'name' ) + '\n';
                //     chosenFilesUrl += ( i + 1 ) + '. ' + file.getUrl() + '\n';
                // } );
                //
                // console.log( 'AD '+chosenFilesName );
                // console.log( 'URL '+chosenFilesUrl );


            });

            finder.on('file:choose:resizedImage', function (evt) {
                // var outputFileName = document.getElementById( 'file-name' );
                // var outputFileUrl = document.getElementById( 'file-url' );
                // outputFileName.innerText = 'Selected resized image: ' + evt.data.file.get( 'name' );
                // outputFileUrl.innerText = 'URL: ' + evt.data.resizedUrl;


                document.getElementById('image_label').value = evt.data.resizedUrl;
                document.querySelector('.previewImage').src = evt.data.resizedUrl;
                $('.notPhotoPost').css('display', 'flex');


            });


        }
    });


}


function ckfinderAloneButtonForOptions(x, y, type, imgClassName) {
    CKFinder.modal({
        chooseFiles: true,
        language: langaugeDefault,
        resourceType: type, //Ancaq image gosterir
        width: x * 0.8,
        height: y * 0.8,
        plugins: [
            // Path must be relative to the location of ckfinder.js file
            'samples/plugins/StatusBarInfo/StatusBarInfo'
        ],
        onInit: function (finder) {
            finder.on('files:choose', function (evt) {
                var file = evt.data.files.first();
                // var outputFileName = document.getElementById( 'file-name' );
                // var outputFileUrl = document.getElementById( 'file-url' );
                // outputFileName.innerText = 'Selected: ' + file.get( 'name' );
                // outputFileUrl.innerText = 'URL: ' + file.getUrl();


                document.getElementById('image_label-' + imgClassName).value = file.getUrl();
                document.querySelector('.imgClassName-' + imgClassName).src = file.getUrl();
                $('.notPhotoOption-' + imgClassName).css('display', 'flex');


                // var files = evt.data.files;
                //
                // var chosenFilesName = '';
                // var chosenFilesUrl = '';
                //
                // files.forEach( function( file, i ) {
                //     chosenFilesName += ( i + 1 ) + '. ' + file.get( 'name' ) + '\n';
                //     chosenFilesUrl += ( i + 1 ) + '. ' + file.getUrl() + '\n';
                // } );
                //
                // console.log( 'AD '+chosenFilesName );
                // console.log( 'URL '+chosenFilesUrl );


            });

            finder.on('file:choose:resizedImage', function (evt) {
                // var outputFileName = document.getElementById( 'file-name' );
                // var outputFileUrl = document.getElementById( 'file-url' );
                // outputFileName.innerText = 'Selected resized image: ' + evt.data.file.get( 'name' );
                // outputFileUrl.innerText = 'URL: ' + evt.data.resizedUrl;


                document.getElementById('image_label-' + imgClassName).value = evt.data.resizedUrl;
                document.querySelector('.imgClassName-' + imgClassName).src = evt.data.resizedUrl;
                $('.notPhotoOption-' + imgClassName).css('display', 'flex');


            });


        }
    });


}

function ckfinderAloneButtonMultiple(x, y, type) {


    CKFinder.modal({
        chooseFiles: true,
        language: langaugeDefault,
        resourceType: type, //Ancaq image gosterir
        width: x * 0.8,
        height: y * 0.8,
        plugins: [
            // Path must be relative to the location of ckfinder.js file
            'samples/plugins/StatusBarInfo/StatusBarInfo'
        ],
        onInit: function (finder) {
            finder.on('files:choose', function (evt) {
                var file = evt.data.files.first();
                // var outputFileName = document.getElementById( 'file-name' );
                // var outputFileUrl = document.getElementById( 'file-url' );
                // outputFileName.innerText = 'Selected: ' + file.get( 'name' );
                // outputFileUrl.innerText = 'URL: ' + file.getUrl();


                // document.getElementById('image_label').value = file.getUrl();
                // document.querySelector('.previewImage').src = file.getUrl();
                // $('.notPhotoPost').css('display', 'flex');


                var files = evt.data.files;

                var chosenFilesName = '';
                var chosenFilesUrl = '';

                files.forEach(function (file, i) {
                    // chosenFilesName += file.get( 'name' );
                    // chosenFilesUrl += file.getUrl();
                    $('#sortable').append(`<div class="images-box-item">
                         <div class="removeButton">
                            <span class="fa fa-times"></span>
                        </div>
                      <img width="200" src="${file.getUrl()}" >
                      <input form="submit-form" type="hidden" name="images[]" value="${file.getUrl()}">
                      </div>`)

                });

                // console.log( 'AD '+chosenFilesName );
                // console.log( 'URL '+chosenFilesUrl );


            });

            finder.on('file:choose:resizedImage', function (evt) {
                // var outputFileName = document.getElementById( 'file-name' );
                // var outputFileUrl = document.getElementById( 'file-url' );
                // outputFileName.innerText = 'Selected resized image: ' + evt.data.file.get( 'name' );
                // outputFileUrl.innerText = 'URL: ' + evt.data.resizedUrl;


                document.getElementById('image_label').value = evt.data.resizedUrl;
                document.querySelector('.previewImage').src = evt.data.resizedUrl;
                $('.notPhotoPost').css('display', 'flex');


            });


        }
    });


}

function ckfinderAloneButtonMultipleImageAndVideo(x, y, type) {


    CKFinder.modal({
        chooseFiles: true,
        language: langaugeDefault,
        resourceType: type, //Ancaq image gosterir
        width: x * 0.8,
        height: y * 0.8,
        plugins: [
            // Path must be relative to the location of ckfinder.js file
            'samples/plugins/StatusBarInfo/StatusBarInfo'
        ],
        onInit: function (finder) {
            finder.on('files:choose', function (evt) {
                var file = evt.data.files.first();
                // var outputFileName = document.getElementById( 'file-name' );
                // var outputFileUrl = document.getElementById( 'file-url' );
                // outputFileName.innerText = 'Selected: ' + file.get( 'name' );
                // outputFileUrl.innerText = 'URL: ' + file.getUrl();


                // document.getElementById('image_label').value = file.getUrl();
                // document.querySelector('.previewImage').src = file.getUrl();
                // $('.notPhotoPost').css('display', 'flex');


                var files = evt.data.files;

                var chosenFilesName = '';
                var chosenFilesUrl = '';

                files.forEach(function (file, i) {
                    // chosenFilesName += file.get( 'name' );
                    // chosenFilesUrl += file.getUrl();
                    $('#sortable').append(`<div class="images-box-item">
                         <div class="removeButton">
                            <span class="fa fa-times"></span>
                        </div>
                        <div class="gallery-image-tools-box">
                         <i class="far fa-image"></i>

                            <div data-element-type="1" data-element-url="${file.getUrl()}" class="fa fa-eye showImageOrVideoModalButton" data-toggle="modal" data-target="#showImageOrVideoModalButton"></div>
                        </div>
                      <img width="200" src="${file.getUrl()}" >
                      <input form="submit-form" type="hidden" name="files[link][]" value="${file.getUrl()}">
                      <input form="submit-form" type="hidden" name="files[type][]" value="1">
                      </div>`)

                });

                // console.log( 'AD '+chosenFilesName );
                // console.log( 'URL '+chosenFilesUrl );


            });

            finder.on('file:choose:resizedImage', function (evt) {
                // var outputFileName = document.getElementById( 'file-name' );
                // var outputFileUrl = document.getElementById( 'file-url' );
                // outputFileName.innerText = 'Selected resized image: ' + evt.data.file.get( 'name' );
                // outputFileUrl.innerText = 'URL: ' + evt.data.resizedUrl;


                document.getElementById('image_label').value = evt.data.resizedUrl;
                document.querySelector('.previewImage').src = evt.data.resizedUrl;
                $('.notPhotoPost').css('display', 'flex');


            });


        }
    });


}


/*   CKFINDER KOMEKCI BUTTON END   */


/*   CACHE CLEAR START   */
$(document).on('click', '#cache-clear', function () {
    $.ajax({
        url: cacheClearRoute,
        type: 'POST',
        data: {data: true},
        dataType: 'JSON',
        success: function (data) {
            if (data.success == true) {
                toastr.success(cacheClear);
            } else {
                toastr.error("Xəta baş verdi");
            }
        }
    });
})
/*   CACHE CLEAR END   */


/*   OPTION TYPE CHANGE START   */
$(document).on('change', '.option-type', function () {
    let optionTypeVal = $(this).val();

    if (optionTypeVal == 1) {
        $('.option-image-colum').show();
    }


    if (optionTypeVal == 2) {
        $('.option-image-colum').hide();
    }

    // if(optionTypeVal == 4 || optionTypeVal == 5 || optionTypeVal == 6 || optionTypeVal == 7 || optionTypeVal == 8 || optionTypeVal == 9){
    //     console.log(optionTypeVal);
    //     $('.option-status').hide();
    // }

});

/*   OPTION TYPE CHANGE END   */


/*   MAKE STRING START   */
function makeString(length) {
    var result = '';
    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for (var i = 0; i < length; i++) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
}
/*   MAKE STRING END   */








/*   RIGHT SIDEBAR STAUS HIDE OR SHOW START   */

let checkRightSidebar = $('.container-fluid').find('.col-my-lg-4').length;
let checkLeftSidebar = $('.container-fluid').find('.col-my-lg-8').length;

if(checkRightSidebar == '1' && checkLeftSidebar == '1'){

    $('.subheader').find('.container-fluid').append(`
  <div class="right-sidebar-status-right-container">
        <i class="fas fa-angle-double-right"></i>
  </div>

 <div class="right-sidebar-status-left-container" right-sidebar-status="0">
    <i class="fas fa-angle-double-left"></i>
</div>

`);



if (getWindowWidth <= 1200) {
    $('.right-sidebar-status-right-container').hide();
    $('.right-sidebar-status-left-container').hide();
} else {
    $('.right-sidebar-status-left-container').hide();
    $('.right-sidebar-status-right-container').css('display','flex');
}



$(window).resize(function () {
    $('.select2-container').css('width','100%');
    getWindowWidth = $(window).width();
    if (getWindowWidth <= 1200) {
        $('.right-sidebar-status-right-container').hide();
        $('.right-sidebar-status-left-container').hide();
        $('.container-fluid .row .col-my-lg-4').show();
    } else {
        let rightSidebarStatus = $('.right-sidebar-status-left-container').attr('right-sidebar-status');
        if(rightSidebarStatus == '1'){
            $('.container-fluid .row .col-my-lg-4').hide();
            $('.container-fluid .row .col-my-lg-8').css('flex','0 0 100%').css('max-width','100%');
            $('.right-sidebar-status-right-container').hide();
            $('.right-sidebar-status-left-container').css('display','flex');
        }else {
            $('.container-fluid .row .col-my-lg-4').show();
            $('.container-fluid .row .col-my-lg-8').removeAttr('style');
            $('.right-sidebar-status-right-container').css('display','flex');
            $('.right-sidebar-status-left-container').hide();
        }
    }
});

$(document).on('click','.right-sidebar-status-right-container',function (){
    $('.right-sidebar-status-left-container').attr('right-sidebar-status','1');
    $('.right-sidebar-status-left-container').css('display','flex');
    $(this).hide();
    $('.container-fluid .row .col-my-lg-4').hide();
    $('.container-fluid .row .col-my-lg-8').css('flex','0 0 100%').css('max-width','100%');
});


$(document).on('click','.right-sidebar-status-left-container',function (){
    $(this).attr('right-sidebar-status','0');
    $('.container-fluid .row .col-my-lg-4').show();
    $('.container-fluid .row .col-my-lg-8').removeAttr('style');
    $('.right-sidebar-status-left-container').hide();
    $('.right-sidebar-status-right-container').css('display','flex');
});
}


    /*   RIGHT SIDEBAR STAUS HIDE OR SHOW END   */
