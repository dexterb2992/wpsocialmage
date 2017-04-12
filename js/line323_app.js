html2canvas($(".image-holder"), {
                    onrendered: function(canvas) {
                        theCanvas = canvas;

                        var imageData = canvas.toDataURL("image/png");
                        window.globalDataUrl = imageData;

                        var blob = "";
                        try {
                            blob = dataURItoBlob(imageData);
                        } catch (e) {
                            console.log(e);
                        }
                        var fd = new FormData();
                        fd.append("access_token", fbAccessToken);
                        fd.append("source", blob);
                        fd.append("message", $("#post_title").val());

                        try {
                            var btn = $("#post_to_fb");

                            btn.html("Please wait...").addClass("disabled").attr("disabled", "disabled");

                            $.ajax({
                                url: "https://graph.facebook.com/"+albumId+"/photos",
                                type: "POST",
                                data: fd,
                                processData: false,
                                contentType: false,
                                cache: false,
                                beforeSend : function (){
                                    btn.html("Posting...").addClass("disabled").attr("disabled", "disabled");
                                },
                                success: function (data) {
                                    imgUploadedId = data.id;
                                    

                                    // let's get the url of the newly uploaded image
                                    FB.api("/"+imgUploadedId, function (response) {
                                        console.log(response);
                                        // if (response && !response.error) {
                                            /* handle the result */
                                            imgUploadedUrl = response.source;
                                            imgUploadedLink = response.link;

                                            // let's choose where we want it to be posted
                                            if( $("#target_url").val() !== "" ){  // this means, the image should be clickable
                                                console.log("/we are posting inside IF when target_url is not empty");
                                                console.log("whereToPost: ");
                                                console.log(whereToPost);
                                                try{
                                                    
                                                    var img_is_deleted = false;
                                                    $.each(whereToPost, function(i, row){
                                                        var check_if_page = $.inArray(row, pages_array);
                                                        // Make sure not to include page
                                                        if( check_if_page < 0 ){
                                                            FB.api('/'+row+'/feed', 'post', {
                                                                  name: $("#post_title").val(),
                                                                  link: $("#target_url").val(),
                                                                  picture: imgUploadedUrl,
                                                                  description: $("#post_description").val(),
                                                                  message : $("#post_message").val()
                                                                }, function (response){
                                                                    console.log("response when target_url is not empty:");
                                                                    console.log(response);
                                                                    // let's delete the image post to prevent duplicate posts
                                                                    if( img_is_deleted === false && $.trim( $("#target_url").val() ) !== "" ){
                                                                        $.ajax({
                                                                            url: "https://graph.facebook.com/"+imgUploadedId+"?method=DELETE&access_token="+fbAccessToken,
                                                                            type: 'post',
                                                                            processData: false,
                                                                            contentType: false,
                                                                            cache: false,
                                                                            beforeSend: function (){
                                                                                console.log("deleting user image now...");
                                                                            },
                                                                            success: function (data){
                                                                                console.log(data);
                                                                                img_is_deleted = true;
                                                                            },
                                                                            error: function(shr, status, data){
                                                                                console.log("Error while deleting user image." + data + " Status " + shr.status);
                                                                            }
                                                                        });
                                                                    }
                                                                }
                                                            );
                                                        }
                                                    });
                                                    
                                                }catch(Exception){
                                                    console.log("ERROR: ");
                                                    console.log(Exception);
                                                }
                                            }else{
                                                $.each(whereToPost, function(i, row){
                                                    var check_if_page = $.inArray(row, pages_array);
                                                    var pageImgUploadedId = "";

                                                    // Make sure not to include page
                                                    if( check_if_page < 0 ){
                                                        FB.api('/'+row+'/feed', 'post', {
                                                            message: $("#post_title").val(),
                                                            link: imgUploadedLink
                                                            }, function (response) {
                                                                console.log(response);
                                                                if (response && !response.error) {
                                                                    /* handle the result */

                                                                }else{
                                                                    console.log(response);
                                                                }
                                                            }
                                                        );
                                                    }

                                                    
                                                    
                                                    
                                                });
                                            }
                                        // }
                                    });
                                },
                                error: function (shr, status, data) {
                                    console.log("error " + data + " Status " + shr.status);
                                    alert("Failed to post on facebook. Please try again later.");
                                    btn.removeAttr("disabled").removeClass("disabled").html("POST");
                                },
                                complete: function () {
                                    console.log("Posted to facebook");
                                    alert("Posted to facebook successfully.");
                                    btn.removeAttr("disabled").removeClass("disabled").html("POST");
                                }
                            });

                            
                            // Here we execute if user has a page id on the where_to_post field
                            $.each(whereToPost, function(i, row){
                                
                                var check_if_page = $.inArray(row, pages_array);

                                if( check_if_page !== -1 ){  // it means, the row is a page ID         
                                    console.log("we're starting to upload image as Page Admin");
                                    // let's upload the image directly to the page as admin
                                    FB.api(fbUserId+'/accounts', function(data){  // getting the page access token
                                        console.log(data);  

                                        var page_access_token = data.data[0].access_token;

                                        var fd = new FormData();
                                        var url = "";
                                        
                                        fd.append("source", blob);
                                        fd.append("message", $("#post_title").val());
                                        url = "https://graph.facebook.com/"+row+"/photos?access_token="+page_access_token;
                                            
                                        $.ajax({
                                            url: url,
                                            type: "POST",
                                            data: fd,
                                            processData: false,
                                            contentType: false,
                                            cache: false,
                                            beforeSend : function (){
                                                console.log("uploading image to page photos...");
                                            },
                                            success: function (response) {
                                                console.log(response);
                                                pageImgUploadedId = response.id;
                                                var pageImgUploadedUrl = "";;

                                                if( $.trim( $("#target_url").val() ) != "" ){
                                                
                                                    // getting the url of newly uploaded picture
                                                    FB.api(row+"/picture?id="+pageImgUploadedId, function(response1){
                                                        console.log(response1);
                                                        if( data.hasOwnProperty('error') ){
                                                            console.log("ERROR while fetching url of newly uploaded photo on page.");
                                                        }else{
                                                            pageImgUploadedUrl= response1.data.url;
                                                            console.log('page image uploaded url: '+pageImgUploadedUrl);

                                                            //let's try to publish to page feed
                                                            var fd2 = new FormData();
                                                            fd2.append("access_token", page_access_token);
                                                            fd2.append("name", $("#post_title").val());
                                                            fd2.append("link", $("#target_url").val());
                                                            fd2.append("caption", $("#post_description").val());
                                                            fd2.append("message", $("#post_message").val());
                                                            fd2.append('picture', pageImgUploadedUrl);
                                                            url2 = "https://graph.facebook.com/"+row+"/feed";

                                                            $.ajax({
                                                                url: url2,
                                                                type: 'post',
                                                                data: fd2,
                                                                processData: false,
                                                                contentType: false,
                                                                cache: false,
                                                                beforeSend: function (){
                                                                    console.log("Posting new image to page feed...");
                                                                },
                                                                success: function (data){
                                                                    console.log(data);
                                                                    alert("Posted to facebook page successfully.");
                                                                    // if success, let's delete the photo post to hide it on the timeline
                                                                    $.ajax({
                                                                        url: "https://graph.facebook.com/"+pageImgUploadedId+"?method=DELETE&access_token="+page_access_token,
                                                                        type: "post",
                                                                        processData: false,
                                                                        contentType: false,
                                                                        cache: false,
                                                                        beforeSend: function (){
                                                                            console.log("deleting image now...");
                                                                        },
                                                                        success: function (data){
                                                                            console.log(data);
                                                                        },
                                                                        error: function (shr, status, data){
                                                                            console.log("error " + data + " Status " + shr.status);
                                                                            btn.removeAttr("disabled").removeClass("disabled").html("POST");
                                                                        }
                                                                    });
                                                                },
                                                                error: function (shr, status, data) {
                                                                    console.log("error " + data + " Status " + shr.status);
                                                                    alert("Failed to post on a facebook page. Please try again later.");
                                                                    btn.removeAttr("disabled").removeClass("disabled").html("POST");
                                                                },
                                                                complete: function () {
                                                                    console.log("Posted to facebook page successfully.");
                                                                    // alert("Posted to facebook successfully.");
                                                                    btn.removeAttr("disabled").removeClass("disabled").html("POST");
                                                                }
                                                            });
                                                        }
                                                    });
                                                }
                                            },
                                            error: function (shr, status, data) {
                                                console.log("error " + data + " Status " + shr.status);
                                                alert("Failed to post on facebook. Please try again later.");
                                                btn.removeAttr("disabled").removeClass("disabled").html("POST");
                                            },
                                            complete: function () {
                                                console.log("Posted to facebook");
                                                // alert("Posted to facebook successfully.");
                                                btn.removeAttr("disabled").removeClass("disabled").html("POST");
                                            }
                                        });
                                    });
                                }
                            });

                        } catch (e) {
                            console.log(e);
                        }
                    }
                });