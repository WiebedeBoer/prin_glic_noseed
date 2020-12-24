(function ($) {

    // add parser through the tablesorter addParser method
    $.tablesorter.addParser({
        id: "customDate",
        is: function (s) {
            //return false;
            //use the above line if you don't want table sorter to auto detected this parser
            //else use the below line.
            //attention: doesn't check for invalid stuff
            //2009-77-77 77:77:77.0 would also be matched
            //if that doesn't suit you alter the regex to be more restrictive
            return /\d{1,2}-\d{1,2}-\d{1,4}/.test(s);
        },
        format: function (s) {
            s = s.split("-");
            return $.tablesorter.formatFloat(new Date(s[2], s[1] - 1, s[0], 0, 0, 0).getTime() + parseInt(0));
        },
        type: "numeric"
    });

    // initial sort set using sortList option
    $("#myTable").tablesorter({
        cssAsc: 'up',
        cssDesc: 'down',
        sortList: [
            [0, 0],
            [1, 0]
        ],
        headers: {
            1: {
                sorter: 'digit'
            }, // column number, type
            3: {
                sorter: 'customDate'
            }
        },
        textExtraction: function (node) {
            // check you're at the right column
            if ($(node).find('h2').length == 1) {
                // extract data from markup and return it
                return $(node).find('h2').find('span').text();
            } else {
                return $(node).text();
            }
        }
    });

    window.click_wait = false;

    $(".clickable-row").click(function (e) {
        if ($(e.target).closest('tr').hasClass('load-inside')) {
            if (window.click_wait === true) {
                return;
            }
            if (!$(e.target).closest('tr').hasClass('more-info-loaded')) {
                $(e.target).closest('tr').find('.loader').removeClass('not-needed');
                $.ajax({
                    url: '/ajax/more-info/' + $(this).data('target-id'),
                }).then(function (data) {
                    $(e.target).closest('tr').find('.more-info-inner').html(data);
                    $(e.target).closest('tr').addClass('more-info-loaded');
                    $(e.target).closest('tr').toggleClass('collapse-more-info');
                    $(e.target).closest('tr').find('.loader').addClass('not-needed');
                    $('#myServerTable').show();
                    make_full_width();
                    setTimeout(function () {
                        $(e.target).closest('tr').find('.more-info-inner').css('max-height', $(e.target).closest('tr').find('.details-page').innerHeight() + 'px');
                        $(e.target).closest('tr').find('.more-info-inner').addClass('show-all');
                    }, 400);
                });
            } else {

                if ($(e.target).closest('tr').find('.more-info-inner').hasClass('show-all')) {
                    $(e.target).closest('tr').find('.more-info-inner').removeClass('show-all');
                    $('#myServerTable').hide();
                } else {
                    setTimeout(function () {
                        $(e.target).closest('tr').find('.more-info-inner').addClass('show-all');
                        $('#myServerTable').show();
                    }, 500);
                }
                setTimeout(function () {
                    $(e.target).closest('tr').toggleClass('collapse-more-info');
                }, 0);
            }
            window.click_wait = true;
            setTimeout(function () {
                window.click_wait = false;
            }, 600);
        } else {
            window.location = $(this).data("href");
        }
    });

    $(".def").click(function () {
        $("#def").val('1');
    });

    $(".datefield").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'dd-mm-yy',
        editable: true,
    });


    // get previous freeze date to ensure there is no possibility of
    // 'retro' input
    var previous_date = $('#previous_freeze_date').val();

    var date1 = new Date(previous_date);
    var date2 = new Date();
    var timeDiff = Math.abs(date2.getTime() - date1.getTime());
    var diffDays = -Math.ceil(timeDiff / (1000 * 3600 * 24)) - 1;

    $(".datefield-restricted").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'dd-mm-yy',
        editable: true,
        minDate: diffDays,
        maxDate: "+1M +10D"
    });
    $("#project_data_date").datepicker('setDate', new Date());

    $(".selectproject").change(function () {
        location.href = '/input?project_id=' + $(this).find(":selected").val();
    });

    /*CKEDITOR.editorConfig = function (config) {
        config.toolbarGroups = [{
                name: 'editing',
                groups: ['find', 'selection', 'spellchecker', 'editing']
            },
            {
                name: 'forms',
                groups: ['forms']
            },
            {
                name: 'basicstyles',
                groups: ['basicstyles', 'cleanup']
            },
            {
                name: 'paragraph',
                groups: ['list', 'indent', 'blocks', 'align', 'bidi', 'paragraph']
            },
            {
                name: 'links',
                groups: ['links']
            },
            {
                name: 'insert',
                groups: ['insert']
            },
            '/',
            {
                name: 'styles',
                groups: ['styles']
            },
            {
                name: 'colors',
                groups: ['colors']
            },
            {
                name: 'tools',
                groups: ['tools']
            },
            {
                name: 'others',
                groups: ['others']
            },
            {
                name: 'about',
                groups: ['about']
            }
        ];

        config.removeButtons = 'Source,Save,NewPage,Preview,Print,Templates,Cut,Copy,Paste,PasteText,PasteFromWord,Redo,Undo,Find,Replace,SelectAll,Scayt,Form,Outdent,Indent,CreateDiv,Blockquote,JustifyLeft,JustifyCenter,JustifyRight,JustifyBlock,Language,BidiRtl,BidiLtr,Image,Flash,Smiley,PageBreak,Iframe,Styles,Format,Font,FontSize,TextColor,BGColor,ShowBlocks,Maximize,About,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField';
    };

    $('#projectform').validate({
        ignore: [],
        rules: {
            project_data_toelichting: {
                required: function () {
                    CKEDITOR.instances.project_data_toelichting.updateElement();
                }
            },
            project_data_toelichting_komend: {
                required: function () {
                    CKEDITOR.instances.project_data_toelichting_komend.updateElement();
                }
            },
            project_data_management_summary: {
                required: function () {
                    CKEDITOR.instances.project_data_management_summary.updateElement();
                }
            }

        },
        messages: {
            project_data_toelichting_komend: "! Please fill out this field.",
            project_data_management_summary: "! Please fill out this field.",
            project_data_toelichting: "! Please fill out this field."
        }

    });**/

    /** Remove required attribute if KPI is 1 or smaller (blank or green) */
    /*$("#project_data_voortgang").change(function () {
        if ($("#project_data_voortgang").val() <= 1) {
            $("#project_data_voortgang_toelichting").removeAttr("required");
        }
    });
    $("#project_data_middelen").change(function () {
        if ($("#project_data_middelen").val() <= 1) {
            $("#project_data_middelen_toelichting").removeAttr("required");
        }
    });
    $("#project_data_scope").change(function () {
        if ($("#project_data_scope").val() <= 1) {
            $("#project_data_scope_toelichting").removeAttr("required");
        }
    });
    $("#project_data_kwaliteit").change(function () {
        if ($("#project_data_kwaliteit").val() <= 1) {
            $("#project_data_kwaliteit_toelichting").removeAttr("required");
        }
    });
    $("#project_data_beleving").change(function () {
        if ($("#project_data_beleving").val() <= 1) {
            $("#project_data_beleving_toelichting").removeAttr("required");
        }
    });*/

    $('label.previous-explanation-do').click(function () {

        if ($(this).parent().find('.previous-explanation').is(":hidden")) {
            $(this).parent().find('.previous-explanation').show();
        } else {
            $(this).parent().find('.previous-explanation').hide();
        }

    });


    /**
     * Insert sortable columns in options list and make cards sortable
     */
    const all_sortables = document.querySelectorAll('.project-table tr th.sortable');
    const sort_select_box = document.querySelector('#sort-select-box');
    const order_radio = document.querySelectorAll('input[name="order-radio"]');
    window.active_sort_index = 0;

    function re_sort() {
        let this_el = $('#myTable').find('th[data-sortname=' + window.active_sort_index + ']');
        let this_index = this_el.prevAll().length;
        let this_order = document.querySelector('input[name="order-radio"]:checked').value;
        let second_sort = this_index === 3 ? [0, 1] : [0, 0];
        $('#myTable').trigger('sorton', [
            [
                [this_index, this_order], second_sort
            ]
        ]);
    }

    if (all_sortables.length > 0 && sort_select_box !== null) {
        $.each(all_sortables, function (key, this_el) {
            let new_option = document.createElement('option');
            new_option.innerText = this_el.innerText;
            new_option.value = this_el.dataset.sortname;
            sort_select_box.appendChild(new_option);
        });
        $(order_radio).on('change', function () {
            re_sort();
        });
        $(sort_select_box).on('change', function (e) {
            window.active_sort_index = e.target.value;
            re_sort();
        });
    }

    /**
     * Switch between card and table layout
     */
    $('input[name="display-style"]').on('change', function (e) {
        if (e.target.value === 'cards') {
            document.body.classList.add('display-cards');
        } else {
            document.body.classList.remove('display-cards');
        }
        Cookies.set('table-display', e.target.value);
    });

    if (Cookies.get('table-display') === 'table') {
        //document.body.classList.remove('display-cards');
        $('#switch-table').click();
    }


    $("#search").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
        $('.page-sort-container').hide();
    });


    /**
     * Set target _blank on all external links
     */
    $('a[href^="http://"], a[href^="https://"]').not('a[href*="' + location.hostname + '"]').attr('target', '_blank');

})(jQuery);

/**
 * Make description block full with when management-resume-and-description contains a table
 */
function make_full_width() {
    jQuery(document).ready(function ($) {
        $.each($('.management-resume-and-description'), function (index, value) {
            if ($('table', value).length > 0) {
                $(value).closest('.management-resume-and-description-and-dates').addClass('full-width');
            }
        });
    });
}