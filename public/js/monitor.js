$(document).ready(function() {
        var dt = new Date();
        var currentDate = dateFormat(dt, 'dddd, dd mmmm yyyy');
        $('#date_today').text(currentDate);

        setInterval('updateClock()', 1000);
    });

    function updateClock ( )
    {
        var currentTime = new Date ( );
        var currentHours = currentTime.getHours ( );
        var currentMinutes = currentTime.getMinutes ( );
        var currentSeconds = currentTime.getSeconds ( );

        // Pad the minutes and seconds with leading zeros, if required
        currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
        currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;

        // Choose either "AM" or "PM" as appropriate
        var timeOfDay = ( currentHours < 12 ) ? "AM" : "PM";

        // Convert the hours component to 12-hour format if needed
        currentHours = ( currentHours > 12 ) ? currentHours - 12 : currentHours;

        // Convert an hours component of "0" to "12"
        currentHours = ( currentHours == 0 ) ? 12 : currentHours;

        // Compose the string for display
        var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay;
        
        
        $("#time").text("(" + currentTimeString + ")");
        
    }

	var checktickdataPerdata, checktickdataPidana;
    var checkshowtickdataPerdata, checkshowtickdataPidana;
    var hideIdxDataPerdata = 0;
    var hideIdxDataPidana = 0;
    var shownIdxDataPerdata = 9;
    var shownIdxDataPidana = 9;
    var showdataPerdata = 8;
    var showdataPidana = 8;

    var maxdataPerdata = 0;
    var maxdataPidana = 0;
    var hoverPerdata = 0;
    var hoverPidana = 0;
 //    var dt = '';
    // GetSelectData();
    GetScreenMonitorPerdata();
    GetScreenMonitorPidana();
    // GetScreenMonitorFootPidana();

    var interval = 15*60000;
    setInterval(function () {
        // GetSelectData();
        GetScreenMonitorPerdata();
        GetScreenMonitorPidana();
        // GetScreenMonitorFootPidana();
    }, interval);

    function GetScreenMonitorPerdata(x, y) {
        $.ajax({
            url: "get_monitor_daftar_perkara",
            dataType: "JSON",
            type: "GET",
            data: { param: x, flag: y },
            beforeSend: function (xhr) {
                //$('#display_tbl_Perdata').html('<tr><td colspan="6" style="text-align:center;"><img src="../../Content/bootstrap/assets/img/ajax-loader-2.gif" width="15px" height="15px"/></td></tr>');
                //setTimeout(x, 3000);
            },
            success: function (data) {
                if (data.content) {
            //         var flag = false;
            //         PerdataArray = [];
            //         $.each(data.data, function (i, e) {
            //             if (e.Status == "true") flag = true;
            //         });

                    var html = "";
                    var idx = 0;
                    var pushit = 0;

                    hideIdxDataPerdata = 0;
                    shownIdxDataPerdata = 9;
                    showdataPerdata = 8;
                    maxdataPerdata = data.content.length;
                    $.each(data.content, function (i, e) {
                        idx++;
                        if (showdataPerdata >= 0) {
                            if (i % 2) html += "<tr class='odd subsequence_idxPerdata_" + idx + " shown'>";
                            else html += "<tr class='even subsequence_idxPerdata_" + idx + " shown'  >";
                        } else {
                            if (i % 2) html += "<tr class='odd subsequence_idxPerdata_" + idx + " hidden'   >";
                            else html += "<tr class='even subsequence_idxPerdata_" + idx + " hidden'  >";
                        }

                        html += "<td style='text-align:left;'>" + e.cabang + "</td>";
                        html += "<td style='text-align:left;'>" + e.unit + "</td>";
                        html += "<td style='text-align:left;'>" + e.jenis_hukum + "</td>";
                        html += "<td style='text-align:left; text-transform:uppercase'>" + e.perkara + "</td>";
                        html += "<td style='text-align:left; text-transform:uppercase'>" + e.pelapor + "</td>";
                        html += "<td style='text-align:left; text-transform:uppercase'>" + e.terlapor + "</td>";
                        html += "<td style='text-align:left; text-transform:uppercase'>" + e.status_perkara + "</td>";
                        html += "<td style='text-align:left; text-transform:uppercase'>" + dateFormat(e.tanggal_status, "dd mmmm yyyy") + "</td>";
                        // html += "<td style='text-align:left;'>" + e.nama_pic + "</td>";
                        showdataPerdata--;
                    });
                    $('#display_data_perdata').html(html);
                    sequenceSHowHideRowTable1();
                }
            }
        });
    }

    var timeDelayPerdata;

    $('#tbl_monitor_daftarpp, #tbl_monitor_daftarpn').mouseover(function () {
        hoverPerdata = 1;
        clearTimeout(timeDelayPerdata);
    }).mouseout(function () {
        hoverPerdata = 0;
        timeDelayPerdata = setTimeout(sequenceSHowHideRowTable1, 5000);
    });

    function sequenceSHowHideRowTable1() {
        if (hoverPerdata == 1) {

        } else {
            if (shownIdxDataPerdata > maxdataPerdata) {
                hideIdxDataPerdata = hideIdxDataPerdata;
                shownIdxDataPerdata = shownIdxDataPerdata;
                clearTimeout(checktickdataPerdata);
                if (showdataPerdata >= 0) checktickdataPerdata = setTimeout(GetScreenMonitorPerdata, 1000 * 60 * 3);
                else checktickdataPerdata = setTimeout(GetScreenMonitorPerdata, 5000);
            } else {
                $(".subsequence_idxPerdata_" + shownIdxDataPerdata).removeClass('hidden');
                $(".subsequence_idxPerdata_" + shownIdxDataPerdata).addClass('shown');
                shownIdxDataPerdata++;
                $(".subsequence_idxPerdata_" + hideIdxDataPerdata).removeClass('shown');
                $(".subsequence_idxPerdata_" + hideIdxDataPerdata).addClass('hidden');
                hideIdxDataPerdata++;
                checkshowtickdataPerdata = setTimeout(sequenceSHowHideRowTable1, 5000);
            }
        }
    }

    function GetScreenMonitorPidana(x, y) {
        $.ajax({
            url: "get_monitor_daftar_notaris",
            dataType: "JSON",
            type: "GET",
            data: { param: x, flag: y },
            beforeSend: function (xhr) {
                //$('#display_tbl_Perdata').html('<tr><td colspan="6" style="text-align:center;"><img src="../../Content/bootstrap/assets/img/ajax-loader-2.gif" width="15px" height="15px"/></td></tr>');
                //setTimeout(x, 3000);
            },
            success: function (data) {
                if (data.content) {
            //         var flag = false;
            //         PerdataArray = [];
            //         $.each(data.data, function (i, e) {
            //             if (e.Status == "true") flag = true;
            //         });

                    var html = "";
                    var idx = 0;
                    var pushit = 0;

                    hideIdxDataPidana = 0;
                    shownIdxDataPidana = 9;
                    showdataPidana = 8;
                    maxdataPidana = data.content.length;
                    $.each(data.content, function (i, e) {
                        idx++;
                        if (showdataPidana >= 0) {
                            if (i % 2) html += "<tr class='odd subsequence_idxPidana_" + idx + " shown'>";
                            else html += "<tr class='even subsequence_idxPidana_" + idx + " shown'  >";
                        } else {
                            if (i % 2) html += "<tr class='odd subsequence_idxPidana_" + idx + " hidden'   >";
                            else html += "<tr class='even subsequence_idxPidana_" + idx + " hidden'  >";
                        }

                        html += "<td style='text-align:left;'>" + e.cabang + "</td>";
                        html += "<td style='text-align:left;'>" + e.unit + "</td>";
                        html += "<td style='text-align:left; text-transform:uppercase'>" + e.debitur + "</td>";
                        html += "<td style='text-align:left; text-transform:uppercase'>" + e.notaris + "</td>";
                        html += "<td style='text-align:left; text-transform:uppercase'>" + e.jenis_pengurusan_nama + "</td>";
                        html += "<td style='text-align:left; text-transform:uppercase'>" + e.nama_status_jaminan + "</td>";
                        html += "<td style='text-align:left; text-transform:uppercase'>" + dateFormat(e.tanggal_status, "dd mmmm yyyy") + "</td>";
                        // html += "<td style='text-align:left; text-transform:uppercase'>" + e.keterangan + "</td>";
                        // html += "<td style='text-align:left;'>" + e.nama_pic + "</td>";
                        showdataPidana--;
                    });
                    $('#display_data_pidana').html(html);
                    sequenceSHowHideRowTable2();
                }
            }
        });
    }

    var timeDelayPidana;

    $('#tbl_monitor_daftarpp, #tbl_monitor_daftarpn').mouseover(function () {
        hoverPidana = 1;
        clearTimeout(timeDelayPidana);
    }).mouseout(function () {
        hoverPidana = 0;
        timeDelayPidana = setTimeout(sequenceSHowHideRowTable1, 5000);
    });

    function sequenceSHowHideRowTable2() {
        if (hoverPerdata == 1) {

        } else {
            if (shownIdxDataPidana > maxdataPidana) {
                hideIdxDataPidana = hideIdxDataPidana;
                shownIdxDataPidana = shownIdxDataPidana;
                clearTimeout(checktickdataPidana);
                if (showdataPidana >= 0) checktickdataPidana = setTimeout(GetScreenMonitorPidana, 1000 * 60 * 3);
                else checktickdataPidana = setTimeout(GetScreenMonitorPidana, 5000);
            } else {
                $(".subsequence_idxPidana_" + shownIdxDataPidana).removeClass('hidden');
                $(".subsequence_idxPidana_" + shownIdxDataPidana).addClass('shown');
                shownIdxDataPidana++;
                $(".subsequence_idxPidana_" + hideIdxDataPidana).removeClass('shown');
                $(".subsequence_idxPidana_" + hideIdxDataPidana).addClass('hidden');
                hideIdxDataPidana++;
                checkshowtickdataPidana = setTimeout(sequenceSHowHideRowTable2, 5000);
            }
        }
    }