
var userID = sessionStorage.getItem("uid");

function toggle_visibility(id, typeoftoggel , appid , appname , appdescription, appstatus, publishdate, typeoftab , apptype , gametype , appicon , userid ,adminname) {
    //console.log(appicon);

    $.ajax({
        url: appicon,
        error: function () {
            appicon = '../assets/images/no_image_icon.gif/';
        },
        async: false,
        success: function () {
            
        }
    });


    if (appicon == '../assets/images/') {
        appicon = '../assets/images/no_image_icon.gif/'
    }

    var e = document.getElementById(id);
    var ApptypeStr="";
    var GametypeStr = "";

    if ("'" + publishdate + "'" == "'" + null + "'")
    {
        publishdate = "No publish date defined";
    }


    if (apptype == "0")
    {
        ApptypeStr = "Game";
    }

    else if (apptype == "1") {
        ApptypeStr = "Story";
    }

    else
        ApptypeStr = "No app type defined";


    if (gametype == "1") {
        GametypeStr = "Running";
    }

    else if (gametype == "0") {
        GametypeStr = "Shooting";
    }

    else
        GametypeStr = "No game type defined";

    var appstatus_name = appstatus;

    if (appstatus == "0") {
        appstatus_name = "Pending";
    }
    else if (appstatus == "1") {
        appstatus_name = "Enabled";
    }
    else if (appstatus == "2") {
        appstatus_name = "Disabled";
    }
    else if (appstatus == "3") {
        appstatus_name = "Rejected";
    }


    


    if (typeoftoggel == "information" && typeoftab == "pending") {
        $.ajax({
            url: mainUrl + '/api/SuperAdminApps/GetTesterDetailsOnAppid',  
            dataType: 'json',
            data: { id: appid},
            type: 'get',
            cache: false,
            async: false,
            success: function (data_tester) {
                $.ajax({
                    url: mainUrl + '/api/SuperAdminApps/uspGetTargetedAudience',   
                    dataType: 'json',
                    data: { id: appid },
                    type: 'get',
                    cache: false,
                    async: false,
                    success: function (data_bu) {

                        var name = "";
                        $(data_tester).each(function (index, value) {
                            if (name != "") {
                                name = name + " , " + value.TesterName;
                            }
                            else
                                name = value.TesterName;
                        });

                        Interior_data_Pendingtab(name,data_bu);
                    },
                    error: function () {
                        Interior_data_Pendingtab(name, "");
                    }
                });


            },
             error: function () {
                 Interior_data_Pendingtab("", data_bu);
             }
        });





          
        function Interior_data_Pendingtab(Ip_testername, data_bu) {

            if (Ip_testername == "") {

                Ip_testername = "No testers Available"
            }

            if (data_bu == "") {
                data_bu = "No Business Units are available"
            }


            $("#popupcontent").append(
            '<img src="' + appicon + '"  style="width:83px; height:82px; margin-left:25px;">' +
            '<div class="tableplace">' +
                '<table cellpadding="8px" style="width: 100%;" class="table" >' +
                     '<col width="35">' +
                     '<col width="220">' +
                    '<tbody>' +
                    '<tr>' +
                    '<th colspan="2">Application Details</th>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>ID :</td>' +
                    '<td class="detail_align">' + appid + '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>Name :</td>' +
                    '<td class="detail_align">' + appname + '</td>' +
                    '</tr>' +
                     '<tr>' +
                    '<td>Created By :</td>' +
                    '<td class="detail_align">' + adminname + '</td>' +
                    '</tr>' +
                     '<tr>' +
                    '<td>Targeted Audience :</td>' +                                  
                    '<td class="detail_align">'+ data_bu +' </td>' +                   
                    '</tr>' +
                    '<tr>' +
                    '<td>Status: </td>' +
                    '<td class="detail_align">' + appstatus_name + '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>Description :</td>' +
                    '<td class="detail_align">' + appdescription + '</td>' +
                    '</tr>' +
                     '<tr>' +
                    '<td>App Type:</td>' +
                    '<td class="detail_align">' + ApptypeStr + '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>Game Type:</td>' +
                    '<td class="detail_align"> ' + GametypeStr + ' </td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>Tester Name\'s:</td>' +
                    '<td class="detail_align">' + Ip_testername + '</td>' +
                    '</tr>' +
                    '</tbody>' +
                '</table>' +
                '<button id="accept_reason" style="margin: 0 0px 0 10px" class="btn"><a>ACCEPT</a></button>' +
                '<button id="reject_reason" style="margin:0px 0px 0px 95px;" class="btn"><a >REJECT</a></button>' +
            '</div>'
            );
            e.style.display = 'block';
        }
     }



    if (typeoftoggel == "information" && (typeoftab == "rejected")) {

        $.ajax({
            url: mainUrl + '/api/SuperAdminApps/GetTesterDetailsOnAppid',  
            dataType: 'json',
            data: { id: appid },
            type: 'get',
            cache: false,
            async: false,
            success: function (data_tester) {

                $.ajax({
                    url: mainUrl + '/api/SuperAdminApps/uspGetTargetedAudience',  
                    dataType: 'json',
                    data: { id: appid },
                    type: 'get',
                    cache: false,
                    async: false,
                    success: function (data_bu) {

                        $.ajax({
                            url: mainUrl + '/api/SuperAdminApps/GetRejectionReason',  // in this sp we need only 
                            dataType: 'json',
                            data: { id: appid },
                            type: 'get',
                            cache: false,
                            async: false,
                            success: function (data_rejcomments) {
                               
                                var name = "";
                                $(data_tester).each(function (index, value) {
                                    if (name != "") {
                                        name = name + " , " + value.TesterName;
                                    }
                                    else
                                        name = value.TesterName;
                                });

                                Interior_data_Rejecttab(name, data_bu,data_rejcomments);


                            },

                            error: function () {
                                Interior_data_Rejecttab(name, data_bu, "");                         
                            }

                        });                      
                    },
                    error: function () {
                        Interior_data_Rejecttab(name, "", data_rejcomments);
                    }
                });
            },
            error: function () {
                Interior_data_Rejecttab("", data_bu, data_rejcomments);
            }
        });






        function Interior_data_Rejecttab(Ip_testername, data_bu, data_rejcomment) {
            /////////////////////////////////////////////////////////////////////////////////
            if (data_rejcomment == "")
            {
                data_rejcomment = "No rejection comments available";
            }

            if (Ip_testername == "") {
                Ip_testername = "No testers Available";
            }

            if (data_bu == "") {
                data_bu = "No Business Units are available";
            }

            $("#popupcontent").append(
            '<img src="' + appicon + '"  style="width:83px; height:82px; margin-left:25px;">' +
            '<div class="tableplace">' +
                 '<table cellpadding="8px" style="width: 100%;" class="table" >' +
                  '<col width="35">' +
                   '<col width="220">' +
                    '<tbody>' +
                    '<tr>' +
                    '<th colspan="2">Application Details</th>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>ID :</td>' +
                    '<td class="detail_align">' + appid + '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>Name :</td>' +
                    '<td class="detail_align">' + appname + '</td>' +
                    '</tr>' +
                     '<tr>' +
                    '<td>Created By :</td>' +
                    '<td class="detail_align"> ' + adminname + ' </td>' +
                    '</tr>' +
                     '<tr>' +
                    '<td>Targeted Audience :</td>' +                                            
                    '<td class="detail_align">' + data_bu + '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>Status: </td>' +
                    '<td class="detail_align">' + appstatus_name + '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>Description :</td>' +
                    '<td class="detail_align">' + appdescription + '</td>' +
                    '</tr>' +
                    '<td>App Type:</td>' +
                    '<td class="detail_align">' + ApptypeStr + '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>Game Type:</td>' +
                    '<td class="detail_align">' + GametypeStr + '</td>' +
                    '</tr>' +

                    '<tr>' +
                    '<td>Rejection Comments:</td>' +
                    '<td class="detail_align">' + data_rejcomment + '</td>' +  
                    '</tr>' +
                    
                    '<td>Tester Name\'s:</td>' +
                    '<td class="detail_align">' + Ip_testername + '</td>' +
                    '</tr>' +
                    '</tbody>' +
                '</table>' +
            '</div>'
            );
            e.style.display = 'block';
        }


    }






    if (typeoftoggel == "information" && (typeoftab == "enabled" || typeoftab == "disabled")) {
        $.ajax({
            url: mainUrl + '/api/SuperAdminApps/GetTesterDetailsOnAppid',  // in this sp we need only 
            dataType: 'json',
            data: { id: appid },
            type: 'get',
            cache: false,
            async: false,
            success: function (data_tester) {
                $.ajax({
                    url: mainUrl + '/api/SuperAdminApps/uspGetTargetedAudience',  // in this sp we need only 
                    dataType: 'json',
                    data: { id: appid },
                    type: 'get',
                    cache: false,
                    async: false,
                    success: function (data_bu) {

                        var name = "";
                        $(data_tester).each(function (index, value) {
                            if (name != "") {
                                name = name + " , " + value.TesterName;
                            }
                            else
                                name = value.TesterName;
                        });

                        Interior_data_Restalltabs(name, data_bu);
                    },
                    error: function () {
                        Interior_data_Restalltabs(name, "");
                    }
                });


            },
            error: function () {
                Interior_data_Restalltabs("", data_bu);
            }
        });






        function Interior_data_Restalltabs(Ip_testername, data_bu) {

            if (Ip_testername == "") {
                Ip_testername="No testers Available"
            }

            if (data_bu == "") {
                data_bu = "No Business Units are available"
            }

            $("#popupcontent").append(
            '<img src="' + appicon + '"  style="width:83px; height:82px; margin-left:25px;">' +
            '<div class="tableplace">' +
                 '<table cellpadding="8px" style="width: 100%;" class="table" >' +
                  '<col width="35">' +
                   '<col width="220">' +
                    '<tbody>' +
                    '<tr>' +
                    '<th colspan="2">Application Details</th>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>ID :</td>' +
                    '<td class="detail_align">' + appid + '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>Name :</td>' +
                    '<td class="detail_align">' + appname + '</td>' +
                    '</tr>' +
                     '<tr>' +
                    '<td>Created By :</td>' +
                    '<td class="detail_align">' + adminname + ' </td>' +
                    '</tr>' +
                     '<tr>' +
                    '<td>Targeted Audience :</td>' +                                            
                    '<td class="detail_align">' + data_bu + '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>Status: </td>' +
                    '<td class="detail_align">' + appstatus_name + '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>Description :</td>' +
                    '<td class="detail_align">' + appdescription + '</td>' +
                    '</tr>' +
                    '<td>App Type:</td>' +
                    '<td class="detail_align">' + ApptypeStr + '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>Game Type:</td>' +
                    '<td class="detail_align">' + GametypeStr + '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>Publish Date:</td>' +
                    '<td class="detail_align">' + publishdate + '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>Tester Name\'s:</td>' +
                    '<td class="detail_align">' + Ip_testername + '</td>' +
                    '</tr>' +
                    '</tbody>' +
                '</table>' +
            '</div>'
            );
            e.style.display = 'block';
        }


    }


        

    if (typeoftoggel == "accept") {


        $.ajax({
            url: mainUrl + '/api/SuperAdminApps/uspGetTargetedAudience',  
            dataType: 'json',
            data: { id: appid },
            type: 'get',
            cache: false,
            async: false,
            success: function (data_bu) {
                Interior_data_accepttab(data_bu);
            },
            error: function () {
                Interior_data_accepttab("");
            }
        });

        function Interior_data_accepttab(data_bu) {

            if (data_bu == "") {
                data_bu = "No Business Units are available"
            }


            $.ajax({
                url: mainUrl + '/api/SuperAdminApps/updAppStatus',
                dataType: 'json',
                data: { id: appid, status: 1 },
                type: 'get',
                cache: false,
                async: false,
                success: function () {
                    $.ajax({
                        url: mainUrl + '/api/SuperAdminApps/updPublishDate',
                        dataType: 'json',
                        data: { id: appid },
                        type: 'get',
                        cache: false,
                        async: false,
                        success: function () { }
                    });
                },

                error: function () {
                }
            });

                $("#popupcontent").append(
                '<img src="' + appicon + '"  style="width:83px; height:82px; margin-left:25px;">' +
                '<h4 align="center">This App has been accepted successfully.</h4>' +
                '<div class="tableplace">' +
                     '<table cellpadding="8px" style="width: 100%;" class="table" >' +
                      '<col width="35">' +
                       '<col width="220">' +
                        '<tbody>' +
                        '<tr>' +
                        '<th colspan="2">Application Details</th>' +
                        '</tr>' +
                        '<tr>' +
                        '<td>ID :</td>' +
                        '<td class="detail_align">' + appid + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td>Name :</td>' +
                        '<td class="detail_align">' + appname + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td>Description :</td>' +
                        '<td class="detail_align">' + appdescription + '</td>' +
                        '</tr>' +
                         '<tr>' +
                        '<td>Created By :</td>' +
                        '<td class="detail_align">' + adminname + '</td>' +
                        '</tr>' +
                         '<tr>' +
                        '<td>Targeted Audience :</td>' +                                       
                        '<td class="detail_align">' + data_bu + '</td>' +
                        '</tr>' +
                        '</tbody>' +
                    '</table>' +

                '</div>');

                $("#pen_tab").empty();
                $("#ena_tab").empty();
                $("#dis_tab").empty();
                $("#rej_tab").empty();

                fresh_dataload();

                e.style.display = 'block';
            }
        }



        if (typeoftoggel == "empty") {
            e.style.display = 'none';
            $("#popupcontent").empty();
        }




        if (typeoftoggel == "reject") {


            $.ajax({
                url: mainUrl + '/api/SuperAdminApps/uspGetTargetedAudience',  
                dataType: 'json',
                data: { id: appid },
                type: 'get',
                cache: false,
                async: false,
                success: function (data_bu) {
                    Interior_data_rejecttab(data_bu);
                },
                error: function () {
                    Interior_data_rejecttab("");
                }
            });

            function Interior_data_rejecttab(data_bu) {

                if (data_bu == "") {
                    data_bu = "No Business Units are available"
                }


                $("#popupcontent").append('<h3 align="center">Rejection</h3>' +
                '<div class="tableplace">' +
                     '<table cellpadding="8px" style="width: 100%;" class="table" >' +
                      '<col width="35">' +
                      '<col width="220">' +
                        '<tbody>' +
                        '<tr>' +
                        '<th colspan="2">Application Details</th>' +
                        '</tr>' +
                        '<tr>' +
                        '<td>ID :</td>' +
                        '<td class="detail_align">' + appid + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td>Name :</td>' +
                        '<td class="detail_align">' + appname + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td>Description :</td>' +
                        '<td class="detail_align">' + appdescription + '</td>' +
                        '</tr>' +
                         '<tr>' +
                        '<td>Created By :</td>' +
                        '<td class="detail_align">' + adminname + '</td>' +
                        '</tr>' +
                         '<tr>' +
                        '<td>Targeted Audience :</td>' +             
                        '<td class="detail_align">' + data_bu + '</td>' +
                        '</tr>' +
                        '</tbody>' +
                    '</table>' +
                    'Please enter a reason for rejection' +
                     '<textarea id="rejection_comments_fromcross" class="textarea"  style="margin:0 0 0 3px;" maxlength="1000" rows="5" autofocus>' +
                     '</textarea>' +
                      '<button id="sub_reject_Fromcross" style="margin:8px 50px 0 45px;" class="btn"><a>SUBMIT</a></button>' +
                '</div>');
                e.style.display = 'block';
            }
        }


        if (typeoftoggel == "lock") {
            
            $("#popupcontent").append(
                 '<br>This Application has been Disabled successfully.<br><br>' +
                 '<div class="tableplace">' +
                 '<table cellpadding="8px" style="width: 100%;" class="table" >' +
                  '<col width="35">' +
                  '<col width="220">' +
                    '<tbody>' +
                    '<tr>' +
                    '<th colspan="2">Application Details</th>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>ID :</td>' +
                    '<td class="detail_align">' + appid + '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>Name :</td>' +
                    '<td class="detail_align">' + appname + '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>Created By :</td>' +
                    '<td class="detail_align">' + adminname + ' </td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>Description :</td>' +
                    '<td class="detail_align">' + appdescription + '</td>' +
                    '</tr>' +
                    '<td>App Type:</td>' +
                    '<td class="detail_align">' + ApptypeStr + '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>Game Type:</td>' +
                    '<td class="detail_align">' + GametypeStr + '</td>' +
                    '</tr>' +
                    '</tbody>' +
                '</table><br><br><br>' +
                '</div>'
                );

            $.ajax({
                url: mainUrl + '/api/SuperAdminApps/updAppStatus',  
                dataType: 'json',
                data: { id: appid, status: 2 },
                type: 'get',
                cache: false,
                async: false,
                success: function () {

                },

                error: function () {
                  
                }

            });

            $("#pen_tab").empty();
            $("#ena_tab").empty();
            $("#dis_tab").empty();
            $("#rej_tab").empty();
            fresh_dataload();
            e.style.display = 'block';

        }




        if (typeoftoggel == "unlock") {
           
            $("#popupcontent").append(
                 '<br>This Application has been Enabled successfully.<br><br>' +
                 '<div class="tableplace">' +
                 '<table cellpadding="8px" style="width: 100%;" class="table" >' +
                  '<col width="35">' +
                  '<col width="220">' +
                    '<tbody>' +
                    '<tr>' +
                    '<th colspan="2">Application Details</th>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>ID :</td>' +
                    '<td class="detail_align">' + appid + '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>Name :</td>' +
                    '<td class="detail_align">' + appname + '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>Created By :</td>' +
                    '<td class="detail_align">' + adminname + ' </td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>Description :</td>' +
                    '<td class="detail_align">' + appdescription + '</td>' +
                    '</tr>' +
                    '<td>App Type:</td>' +
                    '<td class="detail_align">' + ApptypeStr + '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>Game Type:</td>' +
                    '<td class="detail_align">' + GametypeStr + '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td>Publish Date:</td>' +
                    '<td class="detail_align">' + publishdate + '</td>' +
                    '</tr>' +
                    '</tbody>' +
                '</table><br><br><br>' +
                '</div>'
                );

            $.ajax({
                url: mainUrl + '/api/SuperAdminApps/updAppStatus', 
                dataType: 'json',
                data: { id: appid, status: 1 },
                type: 'get',
                cache: false,
                async: false,
                success: function () {

                    $.ajax({
                        url: mainUrl + '/api/SuperAdminApps/updPublishDate',  
                        dataType: 'json',
                        data: { id: appid },
                        type: 'get',
                        cache: false,
                        async: false,
                        success: function () { }
                    });

                },

                error: function () {
                   
                }

            });

            $("#pen_tab").empty();
            $("#ena_tab").empty();
            $("#dis_tab").empty();
            $("#rej_tab").empty();

            fresh_dataload();
            e.style.display = 'block';
        }








        $('#accept_reason').on("click", function () {

            $.ajax({
                url: mainUrl + '/api/SuperAdminApps/uspGetTargetedAudience', 
                data: { id: appid },
                type: 'get',
                cache: false,
                async: false,
                success: function (data_bu) {
                    Interior_data_acceptreason(data_bu);
                },
                error: function () {
                    Interior_data_acceptreason("");
                }
            });

            function Interior_data_acceptreason(data_bu) {

                if (data_bu == "") {
                    data_bu = "No Business Units are available"
                }

                e.style.display = 'none';
                $("#popupcontent").empty();
                e.style.display = 'block';
                $("#popupcontent").append(
                    '<img src="' + appicon + '"  style="width:83px; height:82px; margin-left:25px;">' +
                    '<h4 align="center">This App has been accepted successfully.</h4>' +
                '<div class="tableplace">' +
                     '<table cellpadding="8px" style="width: 100%;" class="table" >' +
                      '<col width="35">' +
                      '<col width="220">' +
                        '<tbody>' +
                        '<tr>' +
                        '<th colspan="2">Application Details</th>' +
                        '</tr>' +
                        '<tr>' +
                        '<td>ID :</td>' +
                        '<td class="detail_align">' + appid + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td>Name :</td>' +
                        '<td class="detail_align">' + appname + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td>Description :</td>' +
                        '<td class="detail_align">' + appdescription + '</td>' +
                        '</tr>' +
                          '<tr>' +
                        '<td>Created By :</td>' +
                        '<td class="detail_align">' + adminname + '</td>' +
                        '</tr>' +
                         '<tr>' +
                        '<td>Targeted Audience :</td>' +
                        '<td class="detail_align">' + data_bu + '</td>' +   
                        '</tr>' +
                        '</tbody>' +
                    '</table>' +
                '</div>');

                $.ajax({
                    url: mainUrl + '/api/SuperAdminApps/updAppStatus', 
                    dataType: 'json',
                    data: { id: appid, status: 1 },
                    type: 'get',
                    cache: false,
                    async: false,
                    success: function () {

                        $.ajax({
                            url: mainUrl + '/api/SuperAdminApps/updPublishDate',  
                            dataType: 'json',
                            data: { id: appid },
                            type: 'get',
                            cache: false,
                            async: false,
                            success: function () { }
                        });


                    },

                    error: function () {
                    }

                });

                $("#pen_tab").empty();
                $("#ena_tab").empty();
                $("#dis_tab").empty();
                $("#rej_tab").empty();

                fresh_dataload();



            }


        });













        $('#reject_reason').on("click", function () {


            $.ajax({
                url: mainUrl + '/api/SuperAdminApps/uspGetTargetedAudience',  
                dataType: 'json',
                data: { id: appid },
                type: 'get',
                cache: false,
                async: false,
                success: function (data_bu) {
                    Interior_data_rejectreason(data_bu);
                },
                error: function () {
                    Interior_data_rejectreason("");
                }
            });

            function Interior_data_rejectreason(data_bu) {

                if (data_bu == "") {
                    data_bu = "No Business Units are available"
                }
                e.style.display = 'none';
                $("#popupcontent").empty();
                e.style.display = 'block';
                $("#popupcontent").append(
                 '<h3 align="center">Rejection</h3>' +
                '<div class="tableplace">' +
                     '<table cellpadding="8px" style="width: 100%;" class="table" >' +
                      '<col width="35">' +
                      '<col width="220">' +
                        '<tbody>' +
                        '<tr>' +
                        '<th colspan="2">Application Details</th>' +
                        '</tr>' +
                        '<tr>' +
                        '<td>ID :</td>' +
                        '<td class="detail_align">' + appid + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td>Name :</td>' +
                        '<td class="detail_align">' + appname + '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td>Description :</td>' +
                        '<td class="detail_align">' + appdescription + '</td>' +
                        '</tr>' +
                          '<tr>' +
                        '<td>Created By :</td>' +
                        '<td class="detail_align">'+adminname+'</td>' +
                        '</tr>' +
                         '<tr>' +
                        '<td>Targeted Audience :</td>' +                                    
                        '<td class="detail_align">' + data_bu + '</td>' +
                        '</tr>' +
                        '</tbody>' +
                    '</table>' +
                    'Please enter a reason for rejection' +
                     '<textarea id="rejection_comments_frominfo" class="textarea"  style="margin:0 0 0 3px;" maxlength="1000" rows="5" autofocus>' +
                     '</textarea>' +
                      '<button id="sub_reject_Frominfo" style="margin:8px 50px 0 45px;" class="btn"><a>SUBMIT</a></button>' +
                '</div>');


                $("#sub_reject_Frominfo").on("click", function () {
                    var text = $("#rejection_comments_frominfo").val();

                    if ($.trim(text) == "") {
                        
                        $("#rejection_comments_frominfo").css('border-color', 'red');
                    }
                    else {
                      $.ajax({
                            url: mainUrl + '/api/SuperAdminApps/updRejectioncomments',
                            dataType: 'json',
                            data: { userID: userid, id: appid, appRejectionComments: text },
                            type: 'get',
                            cache: false,
                            async: false,
                            success: function () {

                            },

                            error: function () {

                            }

                        });


                        $.ajax({
                            url: mainUrl + '/api/SuperAdminApps/updAppStatus',
                            dataType: 'json',
                            data: { id: appid, status: 3 },
                            type: 'get',
                            cache: false,
                            async: false,
                            success: function () {
                            },

                            error: function () {

                            }

                        });

                        toggle_visibility('popupBoxOnePosition', 'empty');
                        $("#pen_tab").empty();
                        $("#ena_tab").empty();
                        $("#dis_tab").empty();
                        $("#rej_tab").empty();
                        fresh_dataload();
                    }


                    

                });

            }
        });







        $("#sub_reject_Fromcross").on("click", function () {

            var text = $("#rejection_comments_fromcross").val();

            if ($.trim(text) == "") {
                
                $("#rejection_comments_fromcross").css('border-color', 'red');
            }

            else {

                $.ajax({
                    url: mainUrl + '/api/SuperAdminApps/updRejectioncomments',
                    dataType: 'json',
                    data: { userID: userid, id: appid, appRejectionComments: text },
                    type: 'get',
                    cache: false,
                    async: false,
                    success: function () {
                    },

                    error: function () {
                    }

                });
            
                $.ajax({
                    url: mainUrl + '/api/SuperAdminApps/updAppStatus',  
                    dataType: 'json',
                    data: { id: appid, status: 3 },
                    type: 'get',
                    cache: false,
                    async: false,
                    success: function () {
                    },
    
                    error: function () {
                    }
    
                });
    
                
                toggle_visibility('popupBoxOnePosition', 'empty');
    
    
                $("#pen_tab").empty();
                $("#ena_tab").empty();
                $("#dis_tab").empty();
                $("#rej_tab").empty();
    
                fresh_dataload();
            
            }
        });

}






function fresh_dataload() {

    
    
    

    $.ajax({
        url: mainUrl + '/api/SuperAdminApps/GetAppDetails1',   
        dataType: 'json',
        contentType: 'application/json',
        type: 'get',
        cache: false,
        async: false,
        success: function (data) {
            $(data).each(function (index, value) {
                var appicon;

                if (value.AppIcon == '../assets/images/') {
                    appicon = '../assets/images/no_image_icon.gif/'
                }

                else {
                    appicon = value.AppIcon;
                }

                

                /*
                $.ajax({
                    url: value.AppIcon,
                    error: function () {
                        console.log('file not exists');
                    },
                    success: function () {             
                        console.log('file exists');
                    }
                });
                */
              
               
                if (value.AppStatus == "0") {
                    $("#pen_tab").append('<div id="wrapper">' +
                      '<div id="inner1">' +
                         '<div id="mainbox">' +
                            '<div id="imagebox"> <img src="' + appicon + '" style="width:83px; height:82px;"></div>' +
                         '</div>' +
                      '</div>' +
                    '<div id="inner2">' +
                    '<div id="textbox"><h5 color:"#212121"; style="word-wrap: break-word; text-align:center; position: relative; bottom: 20px;">' + value.AppName + '</h5></div>' +
                    '</div>' +
                    '<div id="inner3">' +
                      '<div id="buttonbox">' +

                         ' <a href = "#"  onclick="toggle_visibility(\'popupBoxOnePosition\',' + "'reject'" + ',' + value.AppID + ',' + "'" + value.AppName + "'" + ',' + "'" + value.AppDescription + "'" + ',' + "'" + "Pending" + "'" + ',' + "'" + value.PublishedDate + "'" + ',' + "'pending'" + ',' + value.AppType + ',' + value.GameType + ',' + "'" + value.AppIcon + "'" + ',' + "'" + value.UserID + "'" + ',' + "'" + value.Associate_Name + "'" + ')"><span title="Click to Reject App" >    <i class="fa fa-times" style="font-size:25px; color:red; float:right; margin-right:5px;">   </i> </a> ' +
                         ' <a href = "#"  onclick="toggle_visibility(\'popupBoxOnePosition\',' + "'information'" + ',' + value.AppID + ',' + "'" + value.AppName + "'" + ',' + "'" + value.AppDescription + "'" + ',' + "'" + "Pending" + "'" + ',' + "'" + value.PublishedDate + "'" + ',' + "'pending'" + ',' + value.AppType + ',' + value.GameType + ',' + "'" + value.AppIcon + "'" + ',' + "'" + value.UserID + "'" + ',' + "'" + value.Associate_Name + "'" + ')" ><span title="Click for more details"> <i class="fa fa-info-circle" style="font-size:25px; color:black; margin-left:40px;">        </i> </a> ' +
                         ' <a href = "#"  onclick="toggle_visibility(\'popupBoxOnePosition\',' + "'accept'" + ',' + value.AppID + ',' + "'" + value.AppName + "'" + ',' + "'" + value.AppDescription + "'" + ',' + "'" + "Pending" + "'" + ',' + "'" + value.PublishedDate + "'" + ',' + "'pending'" + ',' + value.AppType + ',' + value.GameType + ',' + "'" + value.AppIcon + "'" + ',' + "'" + value.UserID + "'" + ',' + "'" + value.Associate_Name + "'" + ')" ><span title="Click to Accept App"><i class="fa fa-check"   style="font-size:25px; color:green; float:left; margin-left:-5px;"> </i> </a> ' +

                      '</div>' +
                    '</div>' +
                   '</div>');

                }


                if (value.AppStatus == "1") {

                    $("#ena_tab").append('<div id="wrapper">' +
                      '<div id="inner1">' +
                         '<div id="mainbox">' +
                            '<div id="imagebox"> <img src="' + appicon + '" style="width:83px; height:82px;"></div>' +
                         '</div>' +
                      '</div>' +
                    '<div id="inner2">' +
                    '<div id="textbox"><h5 color:"#212121"; style="word-wrap: break-word; text-align:center; position: relative; bottom: 20px;">' + value.AppName + '</h5></div>' +
                    '</div>' +
                    '<div id="inner3">' +
                      '<div id="buttonbox">' +

                         ' <a href = "#"  onclick="toggle_visibility(\'popupBoxOnePosition\',' + "'lock'" + ',' + value.AppID + ',' + "'" + value.AppName + "'" + ',' + "'" + value.AppDescription + "'" + ',' + "'" + "Enabled" + "'" + ',' + "'" + value.PublishedDate + "'" + ',' + "'enabled'" + ',' + value.AppType + ',' + value.GameType + ',' + "'" + value.AppIcon + "'" + ',' + "'" + value.UserID + "'" + ',' + "'" + value.Associate_Name + "'" + ')" ><span title="Click to Disable the App">  <i class="fa fa-lock" style="font-size:25px; color:brown; float:right; margin-right:11px;">   </i> </a> ' +
                         ' <a href = "#"  onclick="toggle_visibility(\'popupBoxOnePosition\',' + "'information'" + ',' + value.AppID + ',' + "'" + value.AppName + "'" + ',' + "'" + value.AppDescription + "'" + ',' + "'" + "Enabled" + "'" + ',' + "'" + value.PublishedDate + "'" + ',' + "'enabled'" + ',' + value.AppType + ',' + value.GameType + ',' + "'" + value.AppIcon + "'" + ',' + "'" + value.UserID + "'" + ',' + "'" + value.Associate_Name + "'" + ')" ><span title="Click for more details"> <i class="fa fa-info-circle" style="font-size:25px; color:black;"></i> </a> ' +

                      '</div>' +
                    '</div>' +
                   '</div>');

                }




                if (value.AppStatus == "2") {

                    $("#dis_tab").append('<div id="wrapper">' +
                      '<div id="inner1">' +
                         '<div id="mainbox">' +
                            '<div id="imagebox"> <img src="' + appicon + '" style="width:83px; height:82px;"></div>' +
                         '</div>' +
                      '</div>' +
                    '<div id="inner2">' +
                    '<div id="textbox"><h5 color:"#212121"; style="word-wrap: break-word; text-align:center; position: relative; bottom: 20px;">' + value.AppName + '</h5></div>' +
                    '</div>' +
                    '<div id="inner3">' +
                      '<div id="buttonbox">' +

                        ' <a href = "#"  onclick="toggle_visibility(\'popupBoxOnePosition\',' + "'unlock'" + ',' + value.AppID + ',' + "'" + value.AppName + "'" + ',' + "'" + value.AppDescription + "'" + ',' + "'" + "Enabled" + "'" + ',' + "'" + value.PublishedDate + "'" + ',' + "'enabled'" + ',' + value.AppType + ',' + value.GameType + ',' + "'" + value.AppIcon + "'" + ',' + "'" + value.UserID + "'" + ',' + "'" + value.Associate_Name + "'" + ')" > <span title="Click to Enable the App">  <i class="fa fa-unlock" style="font-size:25px; color:brown; float:right; margin-right:11px;">   </i> </a> ' +
                        ' <a href = "#"  onclick="toggle_visibility(\'popupBoxOnePosition\',' + "'information'" + ',' + value.AppID + ',' + "'" + value.AppName + "'" + ',' + "'" + value.AppDescription + "'" + ',' + "'" + "Disabled" + "'" + ',' + "'" + value.PublishedDate + "'" + ',' + "'disabled'" + ',' + value.AppType + ',' + value.GameType + ',' + "'" + value.AppIcon + "'" + ',' + "'" + value.UserID + "'" + ',' + "'" + value.Associate_Name + "'" + ')" ><span title="Click for more details"> <i class="fa fa-info-circle" style="font-size:25px; color:black;"></i> </a> ' +

                      '</div>' +
                    '</div>' +
                   '</div>');

                }


                if (value.AppStatus == "3") {

                    $("#rej_tab").append('<div id="wrapper">' +
                      '<div id="inner1">' +
                         '<div id="mainbox">' +
                            '<div id="imagebox"> <img src="' + appicon + '" style="width:83px; height:82px;"></div>' +
                         '</div>' +
                      '</div>' +
                    '<div id="inner2">' +
                    '<div id="textbox"><h5 color:"#212121"; style="word-wrap: break-word; text-align:center; position: relative; bottom: 20px;">' + value.AppName + '</h5></div>' +
                    '</div>' +
                    '<div id="inner3">' +
                      '<div id="buttonbox">' +

                         ' <a href = "#"  onclick="toggle_visibility(\'popupBoxOnePosition\',' + "'information'" + ',' + value.AppID + ',' + "'" + value.AppName + "'" + ',' + "'" + value.AppDescription + "'" + ',' + "'" + "Rejected" + "'" + ',' + "'" + value.PublishedDate + "'" + ',' + "'rejected'" + ',' + value.AppType + ',' + value.GameType + ',' + "'" + value.AppIcon + "'" + ',' + "'" + value.UserID + "'" + ',' + "'" + value.Associate_Name + "'" + ')" ><span title="Click for more details"> <i class="fa fa-info-circle" style="font-size:25px; color:black; margin-left:56px;">        </i> </a> ' +

                      '</div>' +
                    '</div>' +
                   '</div>');
                }






            });


            function isEmpty(el) {
                return !$.trim(el.html())
            }
            if (isEmpty($("#pen_tab"))) {
                // do something
                $("#pen_tab").append('<div class="rec_small_msg">NO PENDING APPS</div>');
            }
            if (isEmpty($("#ena_tab"))) {
                // do something
                $("#ena_tab").append('<div class="rec_small_msg">NO APPS ENABLED</div>');
            }
            if (isEmpty($("#dis_tab"))) {
                // do something
                $("#dis_tab").append('<div class="rec_small_msg">NO APPS DISABLED</div>');
            }
            if (isEmpty($("#rej_tab"))) {
                // do something
                $("#rej_tab").append("NO APPS REJECTED");
            }
           


        },

        error: function () {
           
        }

    });


}





function LoadDataInFilter(Array, typeoffilter) {                 /////////////////////////////////////////////////////////////////////
    
    if (typeoffilter == 'pend') {
        $("#pen_tab").empty();
        if (Array.length == 0)
        {
            $("#pen_tab").append('<div class="rec_small_msg">NO RECORDS FOUND</div>');   //////////////////////////////////////////////////////////////////////////////////////
        }

        $(Array).each(function (index, value) {
            $.ajax({
                type: "GET",
                url: mainUrl + "/api/SuperAdminApps/GetAppDetailsOnAppid",
                data: { id : value},
                datatype: "json",
                contentType: "application/json",
                success: function (data) {
                    $("#pen_tab").append('<div id="wrapper">' +
                      '<div id="inner1">' +
                         '<div id="mainbox">' +
                            '<div id="imagebox"> <img src="' + data[0].AppIcon + '" style="width:83px; height:82px;"></div>' +
                         '</div>' +
                      '</div>' +
                    '<div id="inner2">' +
                    '<div id="textbox"><h5 color:"#212121"; style="word-wrap: break-word; text-align:center; position: relative; bottom: 20px;">' + data[0].AppName + '</h5></div>' +
                    '</div>' +
                    '<div id="inner3">' +
                      '<div id="buttonbox">' +

                         ' <a href = "#"  onclick="toggle_visibility(\'popupBoxOnePosition\',' + "'reject'" + ',' + data[0].AppID + ',' + "'" + data[0].AppName + "'" + ',' + "'" + data[0].AppDescription + "'" + ',' + "'" + "Pending" + "'" + ',' + "'" + data[0].PublishedDate + "'" + ',' + "'pending'" + ',' + data[0].AppType + ',' + data[0].GameType + ',' + "'" + data[0].AppIcon + "'" + ',' + "'" + data[0].UserID + "'" + ',' + "'" + data[0].Associate_Name + "'" + ')"><span title="Click to Reject App" >    <i class="fa fa-times" style="font-size:25px; color:red; float:right; margin-right:5px;">   </i> </a> ' +
                         ' <a href = "#"  onclick="toggle_visibility(\'popupBoxOnePosition\',' + "'information'" + ',' + data[0].AppID + ',' + "'" + data[0].AppName + "'" + ',' + "'" + data[0].AppDescription + "'" + ',' + "'" + "Pending" + "'" + ',' + "'" + data[0].PublishedDate + "'" + ',' + "'pending'" + ',' + data[0].AppType + ',' + data[0].GameType + ',' + "'" + data[0].AppIcon + "'" + ',' + "'" + data[0].UserID + "'" + ',' + "'" + data[0].Associate_Name + "'" + ')" ><span title="Click for more details"> <i class="fa fa-info-circle" style="font-size:25px; color:black; margin-left:40px;">        </i> </a> ' +
                         ' <a href = "#"  onclick="toggle_visibility(\'popupBoxOnePosition\',' + "'accept'" + ',' + data[0].AppID + ',' + "'" + data[0].AppName + "'" + ',' + "'" + data[0].AppDescription + "'" + ',' + "'" + "Pending" + "'" + ',' + "'" + data[0].PublishedDate + "'" + ',' + "'pending'" + ',' + data[0].AppType + ',' + data[0].GameType + ',' + "'" + data[0].AppIcon + "'" + ',' + "'" + data[0].UserID + "'" + ',' + "'" + data[0].Associate_Name + "'" + ')" ><span title="Click to Accept App"><i class="fa fa-check"   style="font-size:25px; color:green; float:left; margin-left:-5px;"> </i> </a> ' +

                      '</div>' +
                    '</div>' +
                   '</div>');
                },
                error: function(){               
                }
            });
        });
    }


    if (typeoffilter == 'enab') {
        $("#ena_tab").empty();
        if (Array.length == 0) {
            $("#ena_tab").append('<div class="rec_small_msg">NO RECORDS FOUND</div>') //////////////////////////////////////////////////////////////////////////
        }
        $(Array).each(function (index, value) {
            $.ajax({
                type: "GET",
                url: mainUrl + "/api/SuperAdminApps/GetAppDetailsOnAppid",
                data: { id: value },
                datatype: "json",
                contentType: "application/json",
                success: function (data) {
                    $("#ena_tab").append('<div id="wrapper">' +
                      '<div id="inner1">' +
                         '<div id="mainbox">' +
                            '<div id="imagebox"> <img src="' + data[0].AppIcon + '" style="width:83px; height:82px;"></div>' +
                         '</div>' +
                      '</div>' +
                    '<div id="inner2">' +
                    '<div id="textbox"><h5 color:"#212121"; style="word-wrap: break-word; text-align:center; position: relative; bottom: 20px;">' + data[0].AppName + '</h5></div>' +
                    '</div>' +
                    '<div id="inner3">' +
                      '<div id="buttonbox">' +

                         ' <a href = "#"  onclick="toggle_visibility(\'popupBoxOnePosition\',' + "'lock'" + ',' + data[0].AppID + ',' + "'" + data[0].AppName + "'" + ',' + "'" + data[0].AppDescription + "'" + ',' + "'" + "Enabled" + "'" + ',' + "'" + data[0].PublishedDate + "'" + ',' + "'enabled'" + ',' + data[0].AppType + ',' + data[0].GameType + ',' + "'" + data[0].AppIcon + "'" + ',' + "'" + data[0].UserID + "'" + ',' + "'" + data[0].Associate_Name + "'" + ')" > <span title="Click to Disable the App"> <i class="fa fa-lock" style="font-size:25px; color:brown; float:right; margin-right:11px;">   </i> </a> ' +
                         ' <a href = "#"  onclick="toggle_visibility(\'popupBoxOnePosition\',' + "'information'" + ',' + data[0].AppID + ',' + "'" + data[0].AppName + "'" + ',' + "'" + data[0].AppDescription + "'" + ',' + "'" + "Enabled" + "'" + ',' + "'" + data[0].PublishedDate + "'" + ',' + "'enabled'" + ',' + data[0].AppType + ',' + data[0].GameType + ',' + "'" + data[0].AppIcon + "'" + ',' + "'" + value.UserID + "'" + ',' + "'" + data[0].Associate_Name + "'" + ')" ><span title="Click for more details"> <i class="fa fa-info-circle" style="font-size:25px; color:black;"></i> </a> ' +

                      '</div>' +
                    '</div>' +
                   '</div>');
                },
                error: function () {
                }
            });
        });
    }


    if (typeoffilter == 'disa') {
        $("#dis_tab").empty();
        if (Array.length == 0) {
            $("#dis_tab").append('<div class="rec_small_msg">NO RECORDS FOUND</div>')//////////////////////////////////////////////////////////////////
        }

        $(Array).each(function (index, value) {
            $.ajax({
                type: "GET",
                url: mainUrl + "/api/SuperAdminApps/GetAppDetailsOnAppid",
                data: { id: value },
                datatype: "json",
                contentType: "application/json",
                success: function (data) {
                    $("#dis_tab").append('<div id="wrapper">' +
                      '<div id="inner1">' +
                         '<div id="mainbox">' +
                            '<div id="imagebox"> <img src="' + data[0].AppIcon + '" style="width:83px; height:82px;"></div>' +
                         '</div>' +
                      '</div>' +
                    '<div id="inner2">' +
                    '<div id="textbox"><h5 color:"#212121"; style="word-wrap: break-word; text-align:center; position: relative; bottom: 20px;">' + data[0].AppName + '</h5></div>' +
                    '</div>' +
                    '<div id="inner3">' +
                      '<div id="buttonbox">' +

                        ' <a href = "#"  onclick="toggle_visibility(\'popupBoxOnePosition\',' + "'unlock'" + ',' + data[0].AppID + ',' + "'" + data[0].AppName + "'" + ',' + "'" + data[0].AppDescription + "'" + ',' + "'" + "Enabled" + "'" + ',' + "'" + data[0].PublishedDate + "'" + ',' + "'enabled'" + ',' + data[0].AppType + ',' + data[0].GameType + ',' + "'" + data[0].AppIcon + "'" + ',' + "'" + data[0].UserID + "'" + ',' + "'" + data[0].Associate_Name + "'" + ')" > <span title="Click to Enable the App"> <i class="fa fa-unlock" style="font-size:25px; color:brown; float:right; margin-right:11px;">   </i> </a> ' +
                        ' <a href = "#"  onclick="toggle_visibility(\'popupBoxOnePosition\',' + "'information'" + ',' + data[0].AppID + ',' + "'" + data[0].AppName + "'" + ',' + "'" + data[0].AppDescription + "'" + ',' + "'" + "Disabled" + "'" + ',' + "'" + data[0].PublishedDate + "'" + ',' + "'disabled'" + ',' + data[0].AppType + ',' + data[0].GameType + ',' + "'" + data[0].AppIcon + "'" + ',' + "'" + data[0].UserID + "'" + ',' + "'" + data[0].Associate_Name + "'" + ')" ><span title="Click for more details"> <i class="fa fa-info-circle" style="font-size:25px; color:black;"></i> </a> ' +

                      '</div>' +
                    '</div>' +
                   '</div>');

                },
                error: function () {
                }
            });
        });
    }



            

}




function gettoparc(ID) {
    //var user = '517299';
    $("#LeaderboardTable").empty();
    $("#LeaderboardposTable").empty();
    $.ajax({
        type: "GET",
        url: mainUrl + "/api/PublishScreen/uspGetTopScoreArc",
        data: { 'appId': ID },
        datatype: "text",
        contentType: "application/json",
        success: function (data) {
            var userrank = 0;
            var username;
            var row$ = $('<tr/>');
            row$.append($('<td/>').html('Rank').css({ "font-weight": "bold", "text-align": "center" }));
            row$.append($('<td/>').html('Name').css({ "font-weight": "bold", "text-align": "center" }));
            row$.append($('<td/>').html('Time Taken').css({ "font-weight": "bold", "text-align": "center" }));
            row$.append($('<td/>').html('Score').css({ "font-weight": "bold", "text-align": "center" }));
            row$.append($('<td/>').html('Reward').css({ "font-weight": "bold", "text-align": "center" }));
            $("#LeaderboardTable").append(row$);
            var k = 1;
            var count = 0;
            for (var i = 0 ; i < data.length ; i++) {
                var row1$ = $('<tr/>');
                row1$.append($('<td/>').html(k));
                row1$.append($('<td/>').html(data[i].Associate_Name));
                row1$.append($('<td/>').html(data[i].TimeTaken));
                row1$.append($('<td/>').html(data[i].Value));
                row1$.append($('<td/>').html(data[i].RewardName));
                $("#LeaderboardTable").append(row1$);
                k++;
            }
            // console.log(userID);
            var row = $('<tr/>');
            //console.log(data.length);
            for (var i = 0; i < data.length; i++) {
                //   console.log(data[i].UserID);
                // if (data[i].UserID == user) { console.log("hellooooo"); }
                if (data[i].UserID == parseInt(userID)) {
                    //alert("hiii");
                    row.append($('<td/>').html(i + 1).css({ "font-weight": "bold", "text-align": "left" }));
                    row.append($('<td/>').html(data[i].Associate_Name).css({ "font-weight": "bold", "text-align": "left" }));
                    row.append($('<td/>').html(data[i].TimeTaken).css({ "font-weight": "bold", "text-align": "left" }));
                    row.append($('<td/>').html(data[i].Value).css({ "font-weight": "bold", "text-align": "left" }));
                    row.append($('<td/>').html(data[i].RewardName).css({ "font-weight": "bold", "text-align": "left" }));
                    $('#LeaderboardposTable').append(row);
                    break;
                }
            }
        },
        error: function (textStatus, errorThrown) {
            console.log("gettoparc function error");
        },
    });
}

function gettopstory(ID) {
    //var user = '516763';
    $("#LeaderboardTable").empty();
    $("#LeaderboardposTable").empty();
    $.ajax({
        type: "GET",
        url: mainUrl + "/api/PublishScreen/uspGetTopScoreStory",
        data: { 'appId': ID },
        datatype: "text",
        contentType: "application/json",
        success: function (data) {
            var row$ = $('<tr/>');
            row$.append($('<td/>').html('Rank').css({ "font-weight": "bold", "text-align": "center" }));
            row$.append($('<td/>').html('Name').css({ "font-weight": "bold", "text-align": "center" }));
            row$.append($('<td/>').html('Score').css({ "font-weight": "bold", "text-align": "center" }));
            row$.append($('<td/>').html('Reward').css({ "font-weight": "bold", "text-align": "center" }));
            $("#LeaderboardTable").append(row$);
            var k = 1;
            for (var i = 0 ; i < data.length ; i++) {
                var row1$ = $('<tr/>');
                row1$.append($('<td/>').html(k));
                row1$.append($('<td/>').html(data[i].Associate_Name));
                row1$.append($('<td/>').html(data[i].Value));
                row1$.append($('<td/>').html(data[i].RewardName));
                $("#LeaderboardTable").append(row1$);
                k++;
            }
            var row = $('<tr/>');
            for (var i = 0; i < data.length; i++) {

                if (data[i].UserID == parseInt(userID)) {
                    row.append($('<td/>').html(i + 1).css({ "font-weight": "bold", "text-align": "left" }));
                    row.append($('<td/>').html(data[i].Associate_Name).css({ "font-weight": "bold", "text-align": "left" }));
                    // row.append($('<td/>').html(data[i].TimeTaken).css({ "font-weight": "bold", "text-align": "left" }));
                    row.append($('<td/>').html(data[i].Value).css({ "font-weight": "bold", "text-align": "left" }));
                    row.append($('<td/>').html(data[i].RewardName).css({ "font-weight": "bold", "text-align": "left" }));
                    $('#LeaderboardposTable').append(row);
                    break;
                }
            }

        },
        error: function (textStatus, errorThrown) {
            console.log("gettopstory function error");
        },
    });
}

function dropdown() {
    $.ajax({
        type: "GET",
        url: mainUrl + "/api/SuperAdminApps/uspGetAllAppName",
        datatype: "text",
        contentType: "application/json",
        success: function (data) {
            var appenddata = "";
            for (var i = 0; i < data.length; i++) {
                appenddata += "<option value = '" + data[i].AppType + "' id='" + data[i].AppID + "' >" + data[i].AppName + " </option>";
            }
            $("#Drop_id").append(appenddata);
        },
        error: function (textStatus, errorThrown) {
            // alert("dropdown function error");
        },
    });
}

jQuery(document).ready(function () {

    
    document.getElementById("myName").innerHTML = sessionStorage.getItem("fname");
    dropdown();
    $('#Drop_id').change(function () {
        var ID = $(this).children(":selected").attr("id");
        var TYPE = $(this).val();
       // console.log(ID);
        //console.log(TYPE);
        if (TYPE == 0) gettoparc(ID);
        else if (TYPE == 1) gettopstory(ID);
    });
    //USER ROLES DROP DOWN
    $("#ddpp").ready(function () {

        $.ajax({
            url: mainUrl + '/api/Landing/userroles',
            data: { 'userid': userID },
            type: 'GET',
            dataType: 'json',
            contentType: 'application/json',

            success: (function (data) {
                //console.log(data[0].AdminStatus);

                if (data[0].AdminStatus == 1) {
                    $('#ddpp').append('<a href="AdminView.html">Admin</a>');
                }
                if (data[0].TesterStatus == 1) {
                    $('#ddpp').append('<a href="#">Tester</a>');
                }
                if (data[0].SuperAdminStatus == 1) {
                    $('#ddpp').append('<a href="superadmin_manage_apps.html">SuperAdmin</a>');
                }


            })

        })
    });
 
    jQuery('.tabs .tab-links a').on('click', function (e) {
        var currentAttrValue = jQuery(this).attr('href');
       
        jQuery('.tabs ' + currentAttrValue).show().siblings().hide();
        
        jQuery(this).parent('li').addClass('active').siblings().removeClass('active');
        e.preventDefault();
    });

    $("#reset2").on("click", function () {
        $('input').val('');
    });
    $("#reset1").on("click", function () {
        $('select').each(function () { this.selectedIndex = 0 });
    });


    $("#reset2").on("click", function () {
        $('select').each(function () { this.selectedIndex = 0 });
    });
    $("#reset3").on("click", function () {
        $('select').each(function () { this.selectedIndex = 0 });
    });
    $("#admins_switch").on("click", function () {
        window.location = "superadmin_admins.html";

    });

    fresh_dataload();

    $.ajax({
        url: mainUrl + '/api/SuperAdminApps/fetch_BusinessUnits',   
        dataType: 'json',
        type: 'get',
        cache: false,
        async: false,
        success: function (data) {
            
            $(data).each(function (index, value) {


                $('#BusinessUnitScroll1')
                .append($("<option></option>")
                .attr("value", $.trim(value.PracticeID))
                .text(value.PracticeName));


                $('#BusinessUnitScroll2')
                .append($("<option></option>")
                .attr("value", $.trim(value.PracticeID))
                .text(value.PracticeName));

                $('#BusinessUnitScroll3')
                .append($("<option></option>")
                .attr("value", $.trim(value.PracticeID))
                .text(value.PracticeName));


            });
        },

        error: function () {
           
        }


    });


    $("#reset1").on("click", function () {
        
        $("#pen_tab").empty();
        $("#ena_tab").empty();
        $("#dis_tab").empty();
        $("#rej_tab").empty();
        fresh_dataload();
    });

    $("#reset2").on("click", function () {
        
        $("#pen_tab").empty();
        $("#ena_tab").empty();
        $("#dis_tab").empty();
        $("#rej_tab").empty();
        fresh_dataload();
    });

    $("#reset3").on("click", function () {
        
        $("#pen_tab").empty();
        $("#ena_tab").empty();
        $("#dis_tab").empty();
        $("#rej_tab").empty();
        fresh_dataload();
    });




    $("#filter_button_inpendingtab").on("click", function () {

        var AppTypeInPending = $("#PenSelectAppType").val();      
        var GameTypeInPending = $("#PenSelectGameType").val();
        var BUIDInPending = $("#BusinessUnitScroll1").val();

        if (AppTypeInPending == 'NULL') {
            AppTypeInPending = "like '%' or AppMaster.AppType is null)";
        }
        else {
            AppTypeInPending = '= ' + AppTypeInPending + ')';
        }

        if (GameTypeInPending == 'NULL') {
            GameTypeInPending = "like '%' or AppMaster.GameType is null)";
        }
        else {
            GameTypeInPending = '= ' + GameTypeInPending + ')';
        }

        if (BUIDInPending == 'NULL') {
            BUIDInPending = "like '%' or BUTable.BUID is null)";
        }
        else {
            BUIDInPending = '= ' + BUIDInPending + ')';
        }

        //console.log("and (BUTable.BUID " + BUIDInPending + " and (AppMaster.AppType " + AppTypeInPending + " and (AppMaster.GameType " + GameTypeInPending + " and AppMaster.AppStatus = 0 ");
        
        
        $.ajax({
            url: mainUrl + '/api/SuperAdminApps/GetFilterdetails',
            dataType: 'json',
            data: { employeeID: "and (BUTable.BUID " + BUIDInPending + " and (AppMaster.AppType " + AppTypeInPending + " and (AppMaster.GameType " + GameTypeInPending + " and AppMaster.AppStatus = 0 "},
            type: 'get',
            cache: false,
            async: false,
            success: function (data) {
                 LoadDataInFilter(data, 'pend')
                //console.log(data);
            },
            error: function () {
               // console.log("error");
            }
        });
        
        
    });


    $("#filter_button_inenabletab").on("click", function () {
        /*
        console.log($("#EnaSelectGameType").val());
        console.log($("#EnaSelectAppType").val());
        console.log($("#BusinessUnitScroll2").val());
        console.log($("#demo-1").val());
        */
        var FilterDate = $("#demo-1").val(); 
        var AppTypeInEnable = $("#EnaSelectAppType").val();
        var GameTypeInEnable = $("#EnaSelectGameType").val();
        var BUIDInEnable = $("#BusinessUnitScroll2").val();

        if (AppTypeInEnable == 'NULL') {
            AppTypeInEnable = "like '%' or AppMaster.AppType is null)";
        }
        else {
            AppTypeInEnable = '= ' + AppTypeInEnable + ')';
        }

        if (GameTypeInEnable == 'NULL') {
            GameTypeInEnable = "like '%' or AppMaster.GameType is null)";
        }
        else {
            GameTypeInEnable = '= ' + GameTypeInEnable + ')';
        }

        if (BUIDInEnable == 'NULL') {
            BUIDInEnable = "like '%' or BUTable.BUID is null)";
        }
        else {
            BUIDInEnable = '= ' + BUIDInEnable + ')';
        }
        var StringDate;
        if (FilterDate == "") {
            StringDate = "and (BUTable.BUID " + BUIDInEnable + " and (AppMaster.AppType " + AppTypeInEnable + " and (AppMaster.GameType " + GameTypeInEnable + " and AppMaster.AppStatus = 1 and (AppMaster.PublishedDate like '%' or AppMaster.PublishedDate is null)";
            //FilterDate = "'%' or AppMaster.PublishedDate is null";
        }
        else {
            FilterDate = FilterDate + '-%';
            StringDate = "and (BUTable.BUID " + BUIDInEnable + " and (AppMaster.AppType " + AppTypeInEnable + " and (AppMaster.GameType " + GameTypeInEnable + " and AppMaster.AppStatus = 1 and (AppMaster.PublishedDate like '" + FilterDate + "')";
        }


        //console.log("and (BUTable.BUID " + BUIDInEnable + " and (AppMaster.AppType " + AppTypeInEnable + " and (AppMaster.GameType " + GameTypeInEnable + " and AppMaster.AppStatus = 1 and (AppMaster.PublishedDate like " + "'"+FilterDate+"'"+")");
       console.log(StringDate);
        
        $.ajax({
            url: mainUrl + '/api/SuperAdminApps/GetFilterdetails',
            dataType: 'json',
            data: { employeeID: StringDate},
            type: 'get',
            cache: false,
            async: false,
            success: function (data) {
                LoadDataInFilter(data, 'enab')
                //console.log(data);
            },
            error: function () {
                //console.log("error");
            }
        });
        
    });

    $("#filter_button_indisabletab").on("click", function () {
        /*
        console.log($("#DisSelectAppType").val());
        console.log($("#DisSelectGameType").val());
        console.log($("#BusinessUnitScroll3").val());
        */

        var AppTypeInDisable = $("#DisSelectAppType").val();
        var GameTypeInDisable = $("#DisSelectGameType").val();
        var BUIDInDisable = $("#BusinessUnitScroll3").val();

        if (AppTypeInDisable == 'NULL') {
            AppTypeInDisable = "like '%' or AppMaster.AppType is null)";
        }
        else {
            AppTypeInDisable = '= ' + AppTypeInDisable+ ')';
        }

        if (GameTypeInDisable == 'NULL') {
            GameTypeInDisable = "like '%' or AppMaster.GameType is null)";
        }
        else {
            GameTypeInDisable = '= ' + GameTypeInDisable+ ')';
        }

        if (BUIDInDisable == 'NULL') {
            BUIDInDisable = "like '%' or BUTable.BUID is null)";
        }
        else {
            BUIDInDisable = '= ' + BUIDInDisable+ ')';
        }

        //console.log("and (BUTable.BUID " + BUIDInDisable + " and (AppMaster.AppType " + AppTypeInDisable + " and (AppMaster.GameType " + GameTypeInDisable + " and AppMaster.AppStatus = 2 ");     

        
        $.ajax({
            url: mainUrl + '/api/SuperAdminApps/GetFilterdetails',
            dataType: 'json',
            data: { employeeID: "and (BUTable.BUID " + BUIDInDisable + " and (AppMaster.AppType " + AppTypeInDisable + " and (AppMaster.GameType " + GameTypeInDisable + " and AppMaster.AppStatus = 2 " },
            type: 'get',
            cache: false,
            async: false,
            success: function (data) {
                LoadDataInFilter(data, 'disa')
                //console.log(data);
            },
            error: function () {
               // console.log("error");
            }
        });

    });


    //PenSelectAppType
    ///PenSelectGameType
    //BusinessUnitScroll1

    
   
    //EnaSelectGameType
    //EnaSelectAppType
    //demo-1
    //BusinessUnitScroll2




    //DisSelectAppType
    //DisSelectGameType
    //BusinessUnitScroll1







});




