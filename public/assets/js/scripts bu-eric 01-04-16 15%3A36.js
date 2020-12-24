(function ($) {

    // global variables set in slider and used in query
    var periodfrom_global = '';
    var periodto_global = '';
    var birthdayfrom_global = '';
    var birthdayto_global = '';
    var dateofdeathfrom_global = '';
    var dateofdeathto_global = '';

    /**
     * Dynamic timeline on homepage

    @TODO remove

    var timeline_json;
    make_the_json = function ()
    {
        $.ajax( {
            url: "/timeline",
            dataType: 'json',
            success: function ( data ){
                var additionalOptions = {
                    default_bg_color: { r: 255, g: 255, b: 255 },
                    timenav_height: 200,
                    timenav_position: 'bottom',
                    scale_factor: 5,
                    initial_zoom: 0,
                    hash_bookmark: false,
                    start_at_slide: 10
                };
                timeline_json = data;
                window.timeline = new TL.Timeline( 'timeline-embed', timeline_json, additionalOptions );
            },
            error: function ( data, status, xhr ){
                console.log( "ERROR:  status " + status + '| xhr: ' + xhr );
                console.log( "data: " + data );
            }
        } );
    };
    // get timeline json only on homepage
    if ( location.search === '' )
    {
        make_the_json();
    }
    */
    /**
     * change filter / sort / order and use data to build query and display results
     */
    jQuery.fn.exists = function(){return this.length>0;};
    $( ".filter" ).change( function ( ){
        handleFormData();
    } );

    /**
     * create slider for birthday range
     */
    $( "#slider-range-period" ).slider( {
        range: true,
        min: 1600,
        max: 2100,
        step: 50,
        values: [ 1600, new Date().getFullYear() ],
        slide: function ( event, ui ){
            $( "#amount-period" ).val( ui.values[ 0 ] + " - " + ui.values[ 1 ] );
            periodfrom_global = ui.values[ 0 ];
            periodto_global = ui.values[ 1 ];
            handleFormData();
        }
    } );
    $( "#amount-period" ).val( $( "#slider-range-period" ).slider( "values", 0 ) +
            " - " + $( "#slider-range-period" ).slider( "values", 1 ) );
    periodfrom_global = $( "#slider-range-period" ).slider( "values", 0 );
    periodto_global = $( "#slider-range-period" ).slider( "values", 1 );

    /**
     * create slider for birthday range
     */
    $( "#slider-range-birthday" ).slider( {
        range: true,
        min: 1600,
        max: 2100,
        step: 50,
        values: [ 1600, new Date().getFullYear() ],
        slide: function ( event, ui ){
            $( "#amount-birthday" ).val( ui.values[ 0 ] + " - " + ui.values[ 1 ] );
            birthdayfrom_global = ui.values[ 0 ];
            birthdayto_global = ui.values[ 1 ];
            $( '#birthday_date_from' ).val( ui.values[ 0 ] + '-01-01' );
            $( '#birthday_date_to' ).val( ui.values[ 1 ] + '-12-31' );
            handleFormData();
        }
    } );
    $( "#amount-birthday" ).val( $( "#slider-range-birthday" ).slider( "values", 0 ) +
            " - " + $( "#slider-range-birthday" ).slider( "values", 1 ) );
    birthdayfrom_global = $( "#slider-range-birthday" ).slider( "values", 0 );
    birthdayto_global = $( "#slider-range-birthday" ).slider( "values", 1 );
    $( '#birthday_date_from' ).val( $( "#slider-range-birthday" ).slider( "values", 0 ) + '-01-01' );
    $( '#birthday_date_to' ).val( $( "#slider-range-birthday" ).slider( "values", 1 ) + '-12-31' );

    /**
     * create slider for date of death range
     */
    $( "#slider-range-dateofdeath" ).slider( {
        range: true,
        min: 1600,
        max: 2100,
        step: 100,
        values: [ 1600, new Date().getFullYear() ],
        slide: function ( event, ui ){
            $( "#amount-dateofdeath" ).val( ui.values[ 0 ] + " - " + ui.values[ 1 ] );
            dateofdeathfrom_global = ui.values[ 0 ];
            dateofdeathto_global = ui.values[ 1 ];
            handleFormData();
        }
    } );
    $( "#amount-dateofdeath" ).val( $( "#slider-range-dateofdeath" ).slider( "values", 0 ) +
            " - " + $( "#slider-range-dateofdeath" ).slider( "values", 1 ) );
    dateofdeathfrom_global = $( "#slider-range-dateofdeath" ).slider( "values", 0 );
    dateofdeathto_global = $( "#slider-range-dateofdeath" ).slider( "values", 1 );

    /**
     * Fill (all) search boxes based on query
     * @returns {undefined}
     */
    fillSearchBox = function ( )
    {
        searchValue = '';
        searchField = '';
        query = location.search;

        if ( getParameterFromStringByName( 'all', query ) !== '' )
        {
            searchValue = getParameterFromStringByName( 'all', query );
            searchField = 'all';
        }
        else if ( getParameterFromStringByName( 'searchfields', query ) !== '' )
        {
            searchValue = getParameterFromStringByName( 'query', query );
            searchField = getParameterFromStringByName( 'searchfields', query );
        }
        else if ( getParameterFromStringByName( 'hoogleraar_achternaam', query ) !== '' )
        {
            searchValue = getParameterFromStringByName( 'hoogleraar_achternaam', query );
            searchField = 'hoogleraar_achternaam';
        }
        else if ( getParameterFromStringByName( 'hoogleraar_voornamen', query ) !== '' )
        {
            searchValue = getParameterFromStringByName( 'hoogleraar_voornamen', query );
            searchField = 'hoogleraar_voornamen';
        }
        else if ( getParameterFromStringByName( 'promotie_titel_dissertatie', query ) !== '' )
        {
            searchValue = getParameterFromStringByName( 'promotie_titel_dissertatie', query );
            searchField = 'promotie_titel_dissertatie';
        }
        if ( searchField === '' )
        {
            searchValue = getParameterFromStringByName( 'query', query );
            searchField = 'all';
        }
        if ( searchValue === '' )
        {
            searchValue = '*:*';
        }
        $( '#query' ).val( searchValue );
        $( '#searchfields' ).val( searchField );

    };

    /**
     * Fill filters with values from advanced search
     */
    fillFilters = function ()
    {
        query = location.search;

        // period
        date_from = getParameterFromStringByName( 'date_from', query ).substring( 0, 4 );
        date_to = getParameterFromStringByName( 'date_to', query ).substring( 0, 4 );
        if ( date_from !== '' && date_to !== '' )
        {
            $( "#slider-range-period" ).slider( 'values', 0, date_from );
            $( "#slider-range-period" ).slider( 'values', 1, date_to );
            $( "#amount-period" ).val( date_from + " - " + date_to );
            periodfrom_global = date_from;
            periodto_global = date_to;
        }
        // birthday
        birthday_date_from = getParameterFromStringByName( 'birthday_date_from', query ).substring( 0, 4 );
        birthday_date_to = getParameterFromStringByName( 'birthday_date_to', query ).substring( 0, 4 );
        if ( birthday_date_from !== '' && birthday_date_to !== '' )
        {
            $( "#slider-range-birthday" ).slider( 'values', 0, birthday_date_from );
            $( "#slider-range-birthday" ).slider( 'values', 1, birthday_date_to );
            $( "#amount-birthday" ).val( birthday_date_from + " - " + birthday_date_to );
            birthdayfrom_global = birthday_date_from;
            birthdayto_global = birthday_date_to;
        }
        // dateofdeath
    };

    /**
     * gather form data and pass to method for further creation of query
     * @returns
     */
    handleFormData = function (){
        var period = [ ];
        var birthday = [ ];
        var dateofdeath = [ ];
        $( '#period-list input:checked' ).each( function ( ){
            period.push( this.value );
        } );
        birthday.push( birthdayfrom_global );
        birthday.push( birthdayto_global );
        dateofdeath.push( dateofdeathfrom_global );
        dateofdeath.push( dateofdeathto_global );
        period.push( periodfrom_global );
        period.push( periodto_global );
        var discipline = $( '#discipline-dropdown option:selected' ).val();
        var sort = $( '#sort-dropdown option:selected' ).val();
        var order = $( '#order-dropdown option:selected' ).val();

        initialQuery = getQuery();
        getSearchResultsQuery( period, discipline, initialQuery, sort, order, birthday, dateofdeath );
    }

    /**
     * build query and pass to method for displaying
     * @param {type} period
     * @param {type} discipline
     * @param {type} initialquery
     * @param {type} sort
     * @param {type} order
     * @param {type} birthday
     * @param {type} dateofdeath
     * @returns none
     */
    getSearchResultsQuery = function ( period, discipline, initialquery, sort, order, birthday, dateofdeath )
    {
        //var basequery = '';
        var query = '';

        // period
        if ( period != null )
        {
            query = query.concat( '&date_from=' + period[0] + '-01-01&date_to=' + period[1] + '-12-31' );
        }
        // birthdate
        if ( birthday != null )
        {
            query = query.concat( '&birthday_date_from=' + birthday[0] + '-01-01&birthday_date_to=' + birthday[1] + '-12-31' );
        }
        // date of death
        if ( dateofdeath != null )
        {
            query = query.concat( '&dateofdeath_date_from=' + dateofdeath[0] + '-01-01&dateofdeath_date_to=' + dateofdeath[1] + '-12-31' );
        }
        // discipline
        if ( discipline != '- all -' && discipline != null )
        {
            query = query.concat( '&discipline=' + discipline );
        }
        else if ( discipline == '- all -' )
        {
            query = query.concat( '&discipline=*' );
        }
        // sort & order
        if ( sort != null )
        {
            if ( order == null )
                order = 'asc';

            if ( sort == 'score' )
            {
                query = query.concat( '&sort=' + sort + '&order=' + order );
            }
            else if ( sort == 'date' )
            {
                query = query.concat( '&sort=hoogleraar_geboortedatum&order=' + order );
            }
            else if ( sort == 'alphabet' )
            {
                query = query.concat( '&sort=hoogleraar_achternaam&order=' + order );
            }
        }
        else
        {
            query = query.concat( '&sort=score&order=' + order );
        }
        //console.log( initialquery + query );
        displaySearchResults( initialquery + query );
        fillSearchBox();
        fillFilters();
    };

    getQuery = function ()
    {
        var initialQuery = '';
        if ( getParameterByName( 'query' ) === '' )
        {
            initialQuery = removeURLParameter( location.search, 'query' ) + '&all=*:*';
            //console.log( initialQuery );
        }
        else if ( getParameterByName( 'searchfields' ) !== '' && getParameterByName( 'query' ) !== '' )
        {
            var searchfields = getParameterByName( 'searchfields' );
            var query = getParameterByName( 'query' );
            initialQuery = removeURLParameter( location.search, 'query' );
            initialQuery = removeURLParameter( initialQuery, 'searchfields' );
            initialQuery = initialQuery + '&' + searchfields + '=' + query;
        }
        else
        {
            initialQuery = location.search;
        }
        if ( getParameterByName( 'searchfields' ) === 'all' )
        {
            initialQuery = initialQuery; // + '&defType=edismax';
        }
        return initialQuery;
    };


    /**
     * get json data, create html and place html in placeholder
     * @param {type} query
     * @returns {undefined}
     */
    displaySearchResults = function ( query ){
        //console.log( 'displalySearchResults: ' + query );
        $.ajax( {
            url: "/search/json" + query,
            dataType: 'json',
            success: function ( data ){
                //console.log( data );
                var items = [ ];
                var numfound = '';
                var start = getParameterFromStringByName( 'start', query );
                //console.log(start);
                var page = 10;
                $.each( data, function ( key, val ){
                    numfound = val.numfound;
                    items.push( "<tr><td><a href='/hoogleraren/" + val.hoogleraar_id + '-' + val.slug + "'>" + val.hoogleraar_achternaam + ', ' + val.hoogleraar_voornamen + ' ' + val.hoogleraar_voorvoegsels + "<img class='search-image' src='/image/" + val.hoogleraar_id + "?size=thumb'/><div>(" + val.hoogleraar_geboortedatum + " - " + val.hoogleraar_overlijdensdatum + ")</div></div><div></div></a></td></tr>" );
                } );
                $( "#search-results" ).empty( );
                $( "<tbody/>", {
                    html: items.join( "" )
                } ).appendTo( "#search-results" );
                var from = numfound === 0 ? numfound : ( start ? parseInt( start ) + 1 : 1 );
                //ensure that until value is not bigger than total items found
                var until = numfound < page ? numfound : ( start ? ( ( parseInt( start ) + parseInt( page ) ) > numfound ? numfound : ( parseInt( start ) + parseInt( page ) ) ) : page );
                if ( numfound == 0 ){
                    from = 0;
                    until = 0;
                }
                items.length == 0 ? $( '#search-sort' ).hide() : $( '#search-sort' ).show();
                $( '#number-of-results' ).html( items.length === 0 ? '0' : numfound );
                $( '#pagination' ).html( buildPagination( items.length === 0 ? '0' : numfound, start, page, removeURLParameter( query, 'start' ) ) );
                $( '#display-results-message' ).html( 'Resultaten ' + from + " tot " + until + ' van ' + ( items.length === 0 ? '0' : numfound ) + '' );
            },
            error: function ( data, status, xhr ){
                console.log( "ERROR:  status " + status + '| xhr: ' + xhr );
                console.log( "data: " + data );
            }
        } );
    };

    // initial search with no searchphrase
    var initialQuery = getQuery();

    // build query and display results when page is first loaded
    if ( location.search != '' )
    {
        getSearchResultsQuery( null, null, initialQuery, 'score', 'asc', null, null );
    }

    /**
     *
     * @param {type} num
     * @param {type} start
     * @param {type} page
     * @param {type} querystring
     * @returns {String}
     */
    buildPagination = function ( num, start, page, querystring )
    {
        var html = '';
        if ( num > 0 )
        {
            var useDots = Math.ceil( num / page ) > 20;
            html = html.concat( '<ul class="pagination">' );

            html = html.concat( '<li><a href="#top" rel="prev" onclick="getSearchResultsQuery(null,null,\'' + querystring + '&start=' + ( start !== null ? ( start - page ) : page ) + '\',false)">«</a></li>' );
            for ( var i = 0; i < Math.ceil( num / page ); i++ )
            {
                if ( start !== null )
                {
                    if ( ( start / page ) === i )
                    {
                        html = html.concat( '<li class = "active" ><a href "#top onclick="getSearchResultsQuery(null,null,\'' + querystring + '&start=' + ( i * page ) + '\' ,false">' + ( i + 1 ) + '</a></li>' );
                    }
                    else
                    {
                        if ( useDots )
                        {
                            if ( ( start / page ) < ( i + 11 ) && ( start / page ) > ( i - 11 ) )
                            {
                                html = html.concat( '<li><a href="#top" onclick="getSearchResultsQuery(null,null, \'' + querystring + '&start=' + ( i * page ) + '\',false)"> ' + ( i + 1 ) + ' </a></li>' );
                            }
                        }
                        else
                        {
                            html = html.concat( '<li><a href="#top" onclick="getSearchResultsQuery(null,null, \'' + querystring + '&start=' + ( i * page ) + '\',false)"> ' + ( i + 1 ) + ' </a></li>' );
                        }
                    }
                }
                else
                {
                    html = html.concat( '<li ' + ( i === 0 ) ? 'class = "active"' : "" + '><a href="#" onclick="getSearchResultsQuery(null,null,\'' + querystring + '&start=' + ( i * page ) + '\'false)"> ' + ( i + 1 ) + ' </a></li>' );
                }
            }
            if ( Math.ceil( start / page ) < i - 1 )
            {
                html = html.concat( '<li><a href="#top" rel = "next" onclick="getSearchResultsQuery(null,null,\'' + querystring + '&start=' + ( start !== null ? ( parseInt( start ) + parseInt( page ) ) : ( parseInt( page ) + parseInt( page ) ) ) + '\',false)"> » </a></li>' );
            }
            html = html.concat( '</ul> ' );
        }
        return html;
    };

    /**
     * autocomplete based on solr search
     *
     * @type Bloodhound
     */
    var hoogleraren = new Bloodhound( {
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace( 'value' ),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        prefetch: '/search/json?all=%QUERY&sort=hoogleraar_achternaam&order=asc',
        remote: {
            url: '/search/json?all=%QUERY&sort=hoogleraar_achternaam&order=asc',
            wildcard: '%QUERY',
            filter: function ( results ){
                // Map the remote source JSON array to a JavaScript object array
                return $.map( results, function ( result ){
                    return {
                        value: result.hoogleraar_achternaam + ', ' + result.hoogleraar_voornamen + ' ' + result.hoogleraar_voorvoegsels,
                        id: result.hoogleraar_id
                    };
                } );
            }
        }
    } );

    /**
     * autocomplete on frontend search
     */
    $( '#remote .typeahead' ).typeahead( null, {
        name: 'hoogleraar_achternaam',
        displayKey: 'value',
        source: hoogleraren,
        limit: 50,
        engine: Hogan
    } ).on( 'typeahead:selected', function ( event, hoogleraar ){
        window.location = '/hoogleraren/' + hoogleraar.id;
    } );

    /**
     * autocomplete on admin search
     */
    $( '#admin .typeahead' ).typeahead( null, {
        name: 'hoogleraar_achternaam',
        displayKey: 'value',
        source: hoogleraren,
        limit: 50,
        engine: Hogan
    } ).on( 'typeahead:selected', function ( event, hoogleraar ){
        window.location = '/admin/hoogleraren/' + hoogleraar.id + '/edit';
    } );

    /**
     * searchable dropdownlist
     */
    $( "select" ).searchable( {
        maxListSize: 100, // if list size are less than maxListSize, show them all
        maxMultiMatch: 50, // how many matching entries should be displayed
        exactMatch: false, // Exact matching on search
        wildcards: true, // Support for wildcard characters (*, ?)
        ignoreCase: true, // Ignore case sensitivity
        latency: 200, // how many millis to wait until starting search
        warnMultiMatch: 'top {0} matches ...', // string to append to a list of entries cut short by maxMultiMatch
        warnNoMatch: 'no matches ...', // string to show in the list when no entries match
        zIndex: 'auto'							// zIndex for elements generated by this plugin
    } );

    /**
     * alphabet search
     */
    $( '.alphabet' ).html( getHTMLAlphabet( ) );

    /**
     * portretinfo
     */
    $( '.portretinfo_click' ).click( function ( ){
        $( "#portretinfo" ).show( );
        $( "#kunstenaar" ).show( );
        $( "#current_tab" ).val( 'portretinfo' );
    } );
    $( "#portretinfo_close" ).click( function ( ){
        $( "#portretinfo" ).hide( );
        $( "#kunstenaar" ).hide( );
        $( "#current_tab" ).val( 'afbeeldingen' );
    } );

    /**
     * import changeForm
     * @param {type} id
     * @returns {undefined}
     */
    changeForm = function ( id )
    {
        $( "#changeForm" + id ).show( );
    };
    $( ".changeForm_close" ).click( function ( ){
        $( ".changeForm" ).hide( );
    } );

    /**
     * display tabs and set styles based on selected or not
     * @param {type} tab
     * @returns {undefined}
     */
    showTab = function ( tab ){
        $( "#current_tab" ).val( tab );
        for ( i = 0; i < tabs.length; i++ ){
            if ( tabs[i] === tab ){
                $( "#" + tabs[i] + "" ).show( );
                $( "#" + tabs[i] + "_click" ).css( "font-weight", "bold" );
                $( "#" + tabs[i] + "_click" ).css( "background", "#dc002d" );
                $( "#" + tabs[i] + "_click" ).css( "color", "#fff" );
            } else{
                $( "#" + tabs[i] + "" ).hide( );
                $( "#" + tabs[i] + "_click" ).css( "font-weight", "normal" );
                $( "#" + tabs[i] + "_click" ).css( "background", "#fff" );
                $( "#" + tabs[i] + "_click" ).css( "color", "#000" );
            }
        }
    };

    /**
     * tabs used
     * @type Array
     */
    var tabs = [ "algemeen", "promoties", "benoemingen", "rector", "dienstverband", "emeritaten", "eredoctoraten", "literatuur", "afbeeldingen", "overige" ];
    html = '';
    for ( i = 0; i < tabs.length; i++ ){
        html = html + '<div id="' + tabs[i] + '_click" onclick="javascript:showTab(\'' + tabs[i] + '\');">' + tabs[i] + '</div>';
    }
    $( '#tabs' ).html( html );
    $( "#algemeen_click" ).css( "font-weight", "bold" );
    $( "#algemeen_click" ).css( "background", "#dc002d" );
    $( "#algemeen_click" ).css( "color", "#fff" );

    /**
     * get anchor value for tabs
     * @type @exp;window@pro;location@pro;hash
     */
    var identifier = window.location.hash;
    if ( identifier === '#portretinfo' ){
        $( "#afbeeldingen_click" ).click( );
        $( "#current_tab" ).val( 'portretinfo' );
        $( "#portretinfo" ).show( );
        $( "#kunstenaar" ).show( );
    } else{
        $( identifier + "_click" ).click( );
    }

    /**
     * image slider for hoogleraar photos
     */
    $( '.bxslider' ).bxSlider( {
        infiniteLoop: false,
        hideControlOnEnd: true,
        changeYear: true,
        slideWidth: 300,
        minSlides: 3,
        maxSlides: 5,
        slideMargin: 10,
    } );

    /**
     * set calendar based on class in input
     */
    if ($('.datefield').exists()) {
        $( ".dateField" ).datepicker( {
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd',
            yearRange: '1614:2015'
        } );
    }
    if ($('#datepicker').exists()) {
        $( "#datepicker" ).datepicker( "option", "dateFormat", $( this ).val( ) );
    }

    jQuery.validator.setDefaults( {
        debug: true,
        success: "valid"
    } );
    $( "#user-form" ).validate( {
        rules: {
            field: {
                required: true
            }
        },
        errorElement: "div",
        wrapper: "div", // a wrapper around the error message
        errorPlacement: function ( error, element ){
            offset = element.offset();
            if ( element.is( ":radio" ) ){
                error.prependTo( element.parent().parent().parent() );
                error.addClass( 'errorAlternative' );
                error.css( 'position', 'absolute' );
                error.css( 'left', element.outerWidth() + 405 );
                error.css( 'top', 15 );
            }
            else{ // This is the default behavior of the script
                //error.insertBefore( element );
                error.addClass( 'error' );  // add a class to the wrapper
                error.css( 'position', 'absolute' );
                error.css( 'left', element.outerWidth() + 20 );
                error.css( 'top', 6 );
            }
        },
        submitHandler: function ( form ){
            //this runs when the form validated successfully
            $( "#submit-form" ).attr( "disabled", true );
            form.submit(); //submit it the form
        }
    } );

    $( 'input[type=password]' ).blur( function (){
        var pass = $( 'input[name=password]' ).val();
        var repass = $( 'input[name=repassword]' ).val();
        if ( ( $( 'input[name=password]' ).val().length == 0 ) || ( $( 'input[name=repassword]' ).val().length == 0 ) ){
            $( '#password' ).addClass( 'has-error' );
        }
        else if ( pass != repass ){
            $( '#password' ).addClass( 'has-error' );
            $( '#repassword' ).addClass( 'has-error' );
            $( '#error-message-password' ).text( 'Wachtwoorden moeten gelijk zijn' );
        }
        else{
            $( '#password' ).removeClass( 'has-error' ).addClass( 'has-success' );
            $( '#repassword' ).removeClass( 'has-error' ).addClass( 'has-success' );
            $( '#error-message-password' ).text( '' );
        }
    } );

})(jQuery);

/**
 * copy selected html and add to certain id
 * @param {type} dup
 * @param {type} after
 * @returns {undefined}
 */
duplicateHtml = function ( dup, after ){
    $( dup ).clone( ).find( "input:text" ).val( "" ).end( )
            .insertAfter( after );
};

/**
 * generate char array a-z
 * @param {type} charA
 * @param {type} charZ
 * @returns {Array|genCharArray.a}
 */
function genCharArray( charA, charZ ){
    var a = [ ], i = charA.charCodeAt( 0 ), j = charZ.charCodeAt( 0 );
    for ( ; i <= j; ++i ){
        a.push( String.fromCharCode( i ) );
    }
    return a;
}

/**
 * get HTML string with a-z list
 * @returns {getHTMLAlphabet.html|String}
 */
function getHTMLAlphabet( )
{
    var alphabet = genCharArray( 'A', 'Z' );
    var html = '';
    alphabet.forEach( function ( entry ){
        html = html.concat( '<div class="letter"><a href="/search?hoogleraar_achternaam=' + entry + '*&hoogleraar_voornamen=&andor=AND">' + entry + '</a></div>' );
    } );
    return html;
}

/**
 * Create a string representation of the date
 * @param {type} date
 * @returns {String}
 */
function formatDate( date ){
    return date.getFullYear( ) + "-" + ( date.getMonth( ) + 1 ) + "-" + date.getDate( );
}

/**
 * get year part from given date
 * @param {type} date
 * @returns {Number}
 */
function getYearFromDate( date ){
    return new Date( date ).getFullYear( );
}

/**
 * Create a new date from a string, return as a timestamp
 * @param {type} str
 * @returns {Number}
 */
function timestamp( str ){
    return new Date( str ).getTime( );
}

/**
 * get value of url parameter based on name
 * @param {type} name
 * @returns {String}
 */
function getParameterByName( name ){
    name = name.replace( /[\[]/, "\\[" ).replace( /[\]]/, "\\]" );
    var regex = new RegExp( "[\\?&]" + name + "=([^&#]*)" ),
            results = regex.exec( location.search );
    return results === null ? "" : decodeURIComponent( results[1].replace( /\+/g, " " ) );
}

/**
 *
 * @param {type} name
 * @param {type} str
 * @returns {String}
 */
function getParameterFromStringByName( name, str ){
    name = name.replace( /[\[]/, "\\[" ).replace( /[\]]/, "\\]" );
    var regex = new RegExp( "[\\?&]" + name + "=([^&#]*)" ),
            results = regex.exec( str );
    return results === null ? "" : decodeURIComponent( results[1].replace( /\+/g, " " ) );
}

/**
 *

 * @param {type} url
 * @param {type} parameter
 * @returns {String} */
function removeURLParameter( url, parameter ){
    //prefer to use l.search if you have a location/link object
    var urlparts = url.split( '?' );
    if ( urlparts.length >= 2 ){

        var prefix = encodeURIComponent( parameter ) + '=';
        var pars = urlparts[1].split( /[&;]/g );
        //reverse iteration as may be destructive
        for ( var i = pars.length; i-- > 0; ){
            //idiom for string.startsWith
            if ( pars[i].lastIndexOf( prefix, 0 ) !== -1 ){
                pars.splice( i, 1 );
            }
        }

        url = urlparts[0] + '?' + pars.join( '&' );
        return url;
    } else{
        return url;
    }
}
