require('./bootstrap');
const Swal = require("sweetalert2");

$(() => {
    setTimeout(() => {
        $('.alert').fadeOut('slow');
    }, 5000);
});

// Set admin
setAdmin = (id, token) => {
    console.log("id:" + id);
    Swal.fire({
        title: 'Set admin?',
        text: 'Are you sure you want to set this user as admin?',
        icon: 'question',
        showCancelButton: true,
        allowEscapeKey: false,
        showLoaderOnConfirm: true,
        allowOutsideClick: false
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Confirm your password.',
                text: 'We need to validate your authentication.',
                icon: 'info',
                showCancelButton: true,
                allowEscapeKey: false,
                allowOutsideClick: false,
                showLoaderOnConfirm: true,
                input: 'password',
                inputPlaceholder: 'Confirm Password',
                inputValidator(value) {
                    if (!value)
                        return 'Please confirm your password';
                }
            }).then((e) => {
                if (e.isConfirmed) {
                    $.ajax({
                        url: 'users/check_password',
                        type: 'post',
                        data: { '_token': token, 'value': e.value },
                        dataType: 'html',
                        success: function (data) {
                            if (data == 1) {
                                $.ajax({
                                    url: 'users/set_admin',
                                    type: 'post',
                                    data: { '_token': token, 'id': id },
                                    dataType: 'html',
                                    success: function (data) {
                                        if (data != '1') {
                                            Swal.fire({
                                                title: 'Unexpected error occurred!',
                                                text: 'Please contact web master to fix the issue. Possible cause: Unidentified user.',
                                                icon: 'error',
                                                allowOutsideClick: false,
                                                allowEscapeKey: false
                                            });
                                        }
                                        else {
                                            Swal.fire({
                                                title: 'Success',
                                                text: 'You successfully set the user as admin.',
                                                icon: 'success',
                                                allowOutsideClick: false,
                                                showLoaderOnConfirm: true,
                                                allowEscapeKey: false
                                            }).then((e) => {
                                                if (e.isConfirmed) {
                                                    window.location.reload();
                                                }
                                            });
                                        }
                                    }
                                }).catch(function (e) {
                                    console.log(e);
                                });
                            }
                            else {
                                Swal.fire({
                                    title: 'Authentication failed!',
                                    text: 'Invalid Credential.',
                                    icon: 'error',
                                    allowOutsideClick: false,
                                    showLoaderOnConfirm: true,
                                    allowEscapeKey: false
                                });
                            }
                        }

                    });
                }

            });
        }
    });
}
// End set admin

// Remove admin

removeAdmin = (id, token) => {
    Swal.fire({
        title: 'Remove admin?',
        text: 'Are you sure you want to remove this user as admin?',
        icon: 'question',
        showCancelButton: true,
        allowEscapeKey: false,
        showLoaderOnConfirm: true,
        allowOutsideClick: false
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Confirm your password.',
                text: 'We need to validate your authentication.',
                icon: 'info',
                showCancelButton: true,
                allowEscapeKey: false,
                allowOutsideClick: false,
                showLoaderOnConfirm: true,
                input: 'password',
                inputPlaceholder: 'Confirm Password',
                inputValidator(value) {
                    if (!value)
                        return 'Please confirm your password';
                }
            }).then((e) => {
                if (e.isConfirmed) {
                    $.ajax({
                        url: 'users/check_password',
                        type: 'post',
                        data: { '_token': token, 'value': e.value },
                        dataType: 'html',
                        success: function (data) {
                            if (data == '1') {
                                $.ajax({
                                    url: 'users/remove_admin',
                                    type: 'post',
                                    data: { '_token': token, 'id': id },
                                    dataType: 'html',
                                    success: function (data) {
                                        if (data != '1') {
                                            Swal.fire({
                                                title: 'Unexpected error occurred!',
                                                text: 'Please contact web master to fix the issue. Possible cause: Unidentified user.',
                                                icon: 'error',
                                                allowOutsideClick: false,
                                                allowEscapeKey: false
                                            });
                                        }
                                        else {
                                            Swal.fire({
                                                title: 'Success',
                                                text: 'You removed user as admin.',
                                                icon: 'success',
                                                allowOutsideClick: false,
                                                allowEscapeKey: false,
                                                showLoaderOnConfirm: true,
                                            }).then((e) => {
                                                if (e.isConfirmed) {
                                                    window.location.reload();
                                                }
                                            });
                                        }
                                    }
                                }).catch(function (e) {
                                    console.log(e);
                                });
                            }
                            else {
                                Swal.fire({
                                    title: 'Authentication failed!',
                                    text: 'Invalid Credential.',
                                    icon: 'error',
                                    allowOutsideClick: false,
                                    showLoaderOnConfirm: true,
                                    allowEscapeKey: false
                                });
                            }
                        }

                    });
                }

            });
        }
    });
}

// End remove admin

// Delete User

deleteUser = (id, token) => {
    Swal.fire({
        title: 'Delete User?',
        text: 'Are you sure you want to delete this user?',
        icon: 'question',
        showCancelButton: true,
        allowEscapeKey: false,
        showLoaderOnConfirm: true,
        allowOutsideClick: false
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Confirm your password.',
                text: 'We need to validate your authentication.',
                icon: 'info',
                showCancelButton: true,
                allowEscapeKey: false,
                allowOutsideClick: false,
                showLoaderOnConfirm: true,
                input: 'password',
                inputPlaceholder: 'Confirm Password',
                inputValidator(value) {
                    if (!value)
                        return 'Please confirm your password';
                }
            }).then((e) => {
                if (e.isConfirmed) {
                    $.ajax({
                        url: 'users/check_password',
                        type: 'post',
                        data: { '_token': token, 'value': e.value },
                        dataType: 'html',
                        success: function (data) {
                            if (data == '1') {
                                $.ajax({
                                    url: 'users/delete_user',
                                    type: 'post',
                                    data: { '_token': token, 'id': id },
                                    dataType: 'html',
                                    success: function (data) {
                                        if (data != '1') {
                                            Swal.fire({
                                                title: 'Unexpected error occurred!',
                                                text: 'Please contact web master to fix the issue. Possible cause: Unidentified user.',
                                                icon: 'error',
                                                allowOutsideClick: false,
                                                allowEscapeKey: false
                                            });
                                        }
                                        else {
                                            Swal.fire({
                                                title: 'Success',
                                                text: 'You successfully deleted the user.',
                                                icon: 'success',
                                                allowOutsideClick: false,
                                                allowEscapeKey: false,
                                                showLoaderOnConfirm: true,
                                            }).then((e) => {
                                                if (e.isConfirmed) {
                                                    window.location.reload();
                                                }
                                            });
                                        }
                                    }
                                }).catch(function (e) {
                                    console.log(e);
                                });
                            }
                            else {
                                Swal.fire({
                                    title: 'Authentication failed!',
                                    text: 'Invalid Credential.',
                                    icon: 'error',
                                    allowOutsideClick: false,
                                    showLoaderOnConfirm: true,
                                    allowEscapeKey: false
                                });
                            }
                        }

                    });
                }

            });
        }
    });
}

// End delete user

/*

$.ajax({
                        url: '/admin/users/set_admin',
                        type: 'post',
                        data: {'_token':token,'id':id},
                        dataType:'html',
                        success: function(data)
                        {
                            if(data != 1)
                            {
                                Swal.fire({
                                   title:'Unexpected error occurred!',
                                   text:'Please contact web master to fix the issue.',
                                    icon:'error',
                                    allowOutsideClick:false,
                                    allowEscapeKey: false
                                });
                            }
                            else
                            {
                                Swal.fire({
                                    title:'Success',
                                    text:'You successfully set the user as admin.',
                                    icon:'success',
                                    allowOutsideClick:false,
                                    allowEscapeKey: false
                                }).then((e) => {
                                    if(e.isConfirmed)
                                    {
                                        window.location.reload();
                                    }
                                });
                            }
                        }
                    }).catch(function(e){
                        console.log(e);
                    });
 */

// Delete News
deleteNews = (id, token) => {
    Swal.fire({
        title: "Delete this article?",
        text: "Are you sure you want to delete this article?",
        allowEscapeKey: false,
        allowOutsideClick: false,
        showCancelButton: true
    }).then((res) => {
        if (res.isConfirmed) {
            $.ajax({
                url: "news/deleteArticle",
                type: 'post',
                data: { id: id, "_token": token },
                dataType: "html",
                success: (data) => {
                    if (data == "1") {
                        Swal.fire({
                            title: 'Success',
                            text: 'You successfully deleted the article.',
                            icon: 'success',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            showLoaderOnConfirm: true,
                        }).then((e) => {
                            if (e.isConfirmed) {
                                window.location.reload();
                            }
                        });
                    }
                    else {
                        Swal.fire({
                            title: 'Unexpected error occurred!',
                            text: 'Please contact web master to fix the issue. Possible cause: Unidentified user.',
                            icon: 'error',
                            allowOutsideClick: false,
                            allowEscapeKey: false
                        });
                    }
                }
            });
        }
    });
}

// passUpdate = (token) => {
//     var currentPass = $("#currentPass").val();
//     var newPass = $("#newPass").val();
//     var confirmPass = $("#confirmPass").val();
//     if (currentPass == "" || newPass == "" || confirmPass == "") {
//         Swal.fire({
//             title: "Error",
//             text: "Please fill out the remaining fields",
//             icon: "error",
//         });
//     }
//     else if (newPass != confirmPass) {
//         Swal.fire({
//             title: "Error",
//             text: "Password do not match",
//             icon: "error",
//         });
//     } else {
//         $.ajax({
//             url: "/passwordUserUpdate",
//             type: 'post',
//             data: {
//                 currentPass: currentPass,
//                 newPass: newPass,
//                 "_token": token
//             },
//             dataType: "html",
//             success: (data) => {
//                 if (data == "1") {
//                     Swal.fire({
//                         title: "Suceess",
//                         text: "Password successfully updated",
//                         icon: "success",
//                         allowOutsideClick: false,
//                         allowEscapeKey: false
//                     }).then((res) => {
//                         if (res.isConfirmed) {
//                             window.location.reload();
//                         }
//                     });
//                 }
//                 else if (data == "2") {
//                     Swal.fire({
//                         title: "Error",
//                         text: "Incorrect Password",
//                         icon: "error"
//                     });
//                 }
//                 else {
//                     Swal.fire({
//                         title: "Unexpected Error",
//                         text: "An Unexpected Error Occurred.",
//                         icon: "error"
//                     });
//                 }
//             }
//         });
//     }

// }