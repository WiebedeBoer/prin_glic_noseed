$( function ( ){

    /**
     * get period from radio and use to build query and display results
     */
    $( ".period" ).change( function ( ){
        handleFormData();
    } );

    /**
     * get discipline from select and use to build query and display results 
     */
    $( "#discipline-dropdown" ).change( function ( ){
        handleFormData();
    } );

    /**
     * get sort field and change order
     */
    $( "#sort-dropdown" ).change( function ( ){
        handleFormData();
    } );

    /**
     * get order field and change order
     */
    $( "#order-dropdown" ).change( function ( ){
        handleFormData();
    } );

    /**
     * create slider for birthday range
     */
    $( "#slider-range-birthday" ).slider( {
        range: true,
        min: 1600,
        max: 2015,
        step: 50,
        values: [ 1614, 2015 ],
        slide: function ( event, ui ){
            $( "#amount-birthday" ).val( ui.values[ 0 ] + " - " + ui.values[ 1 ] );
            handleFormData();
        }
    } );
    $( "#amount-birthday" ).val( $( "#slider-range-birthday" ).slider( "values", 0 ) +
            " - " + $( "#slider-range-birthday" ).slider( "values", 1 ) );

    /**
     * create slider for date of death range
     */
    $( "#slider-range-dateofdeath" ).slider( {
        range: true,
        min: 1600,
        max: 2015,
        step: 50,
        values: [ 1614, 2015 ],
        slide: function ( event, ui ){
            $( "#amount-dateofdeath" ).val( ui.values[ 0 ] + " - " + ui.values[ 1 ] );
            handleFormData();
        }
    } );
    $( "#amount-dateofdeath" ).val( $( "#slider-range-dateofdeath" ).slider( "values", 0 ) +
            " - " + $( "#slider-range-dateofdeath" ).slider( "values", 1 ) );

    /**
     * 
     * @returns {undefined}
     */
    handleFormData = function (){
        var period = [ ];
        var birthday = [ ];
        var dateofdeath = [ ];
        $( '#period-list input:checked' ).each( function ( ){
            period.push( this.value );
        } );
        birthday.push( $( "#slider-range-birthday" ).slider( "values", 0 ) );
        birthday.push( $( "#slider-range-birthday" ).slider( "values", 1 ) );
        dateofdeath.push( $( "#slider-range-dateofdeath" ).slider( "values", 0 ) );
        dateofdeath.push( $( "#slider-range-dateofdeath" ).slider( "values", 1 ) );
        var discipline = $( '#discipline-dropdown option:selected' ).val();
        var sort = $( '#sort-dropdown option:selected' ).val();
        var order = $( '#order-dropdown option:selected' ).val();

        getSearchResults( period, discipline, location.search, sort, order, birthday, dateofdeath );
    }

    /*
     * 
     * @param {type} values
     * @returns {undefined}
     */
    getSearchResults = function ( period, discipline, initialquery, sort, order, birthday, dateofdeath )
    {
        var basequery = '';
        var query = '';

        // period
        if ( period != 'all' && period != null )
        {
            period.forEach( function ( val ){
                query = query.concat( '&date_from=' + ( ( val - 1 ) * 100 ) + '-01-01&date_to=' + ( ( val * 100 ) - 1 ) + '-12-31' );
            } );
        }
        else if ( period == 'all' )
        {
            query = query.concat( '&date_from=1614-01-01&date_to=' + new Date().getFullYear() + '-12-31' );
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
        //console.log(initialquery + query);
        displaySearchResults( initialquery + query );
    };

    /**
     * get json data, create html and place html in placeholder
     * @param {type} query
     * @returns {undefined}
     */
    displaySearchResults = function ( query ){
        console.log(query);
        $.getJSON( "/search/json" + query, function ( data ){
            var items = [ ];
            var numfound = '';
            var start = getParameterFromStringByName( 'start', query );
            var page = 10;
            console.log(data);
            console.log(data.length);
            $.each( data, function ( key, val ){
                numfound = val.numfound;
                items.push( "<tr><td><a href='/hoogleraren/" + val.hoogleraar_id + "'>" + val.hoogleraar_achternaam + ', ' + val.hoogleraar_voornamen + ' ' + val.hoogleraar_voorvoegsels + "<img class='search-image' src='/image/" + val.hoogleraar_id + "'/><div>(" + val.hoogleraar_geboortedatum + " - " + val.hoogleraar_overlijdensdatum + ")</div></div><div></div></a></td></tr>" );
            } );
            $( "#search-results" ).empty( );
            $( "<tbody/>", {
                html: items.join( "" )
            } ).appendTo( "#search-results" );
            var from = numfound === 0 ? numfound : ( start ? parseInt( start ) + 1 : 1 );
            /* ensure that until value is not bigger than total items found */
            var until = numfound < page ? numfound : ( start ? ( ( parseInt( start ) + parseInt( page ) ) > numfound ? numfound : ( parseInt( start ) + parseInt( page ) ) ) : page );
            if ( numfound == 0 ){
                from = 0;
                until = 0;
            }
            items.length == 0 ? $( '#search-sort' ).hide() : $( '#search-sort' ).show();
            $( '#number-of-results' ).html( items.length === 0 ? '0' : numfound );
            $( '#pagination' ).html( buildPagination( items.length === 0 ? '0' : numfound, start, page, removeURLParameter( query, 'start' ) ) );
            $( '#display-results-message' ).html( 'Resultaten ' + from + " tot " + until + ' van ' + ( items.length === 0 ? '0' : numfound ) + '' );
        } );
    };

    // build query and display results when page is first loaded
    getSearchResults( null, null, location.search, 'score', 'asc', null, null );

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
            html = html.concat( '<ul class="pagination">' );

            html = html.concat( '<li><a href="#top" rel="prev" onclick="getSearchResults(null,null,\'' + querystring + '&start=' + ( start !== null ? ( start - page ) : page ) + '\',false)">«</a></li>' );
            for ( var i = 0; i < Math.ceil( num / page ); i++ )
            {
                if ( start !== null )
                {
                    if ( ( start / page ) === i )
                    {
                        html = html.concat( '<li class = "active" ><a href "#top onclick="getSearchResults(null,null,\'' + querystring + '&start=' + ( i * page ) + '\' ,false">' + ( i + 1 ) + '</a></li>' );
                    }
                    else
                    {
                        html = html.concat( '<li><a href="#top" onclick="getSearchResults(null,null, \'' + querystring + '&start=' + ( i * page ) + '\',false)"> ' + ( i + 1 ) + ' </a></li>' );
                    }
                }
                else
                {
                    html = html.concat( '<li ' + ( i === 0 ) ? 'class = "active"' : "" + '><a href="#" onclick="getSearchResults(null,null,\'' + querystring + '&start=' + ( i * page ) + '\'false)"> ' + ( i + 1 ) + ' </a></li>' );
                }
            }
            html = html.concat( '<li><a href="#top" rel = "next" onclick="getSearchResults(null,null,\'' + querystring + '&start="' + ( start !== null ? ( start + page ) : ( page + page ) ) + '\',false)"> » </a></li>' );
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
     * simple and advanced search toggle
     */
    $( "#advanced_search" ).hide( );
    $( "#simple_search_click" ).hide( );
    if ( getParameterByName( "advanced_open" ) === 'true' ){
        $( "#advanced_search" ).show( );
        $( "#simple_search" ).hide( );
        $( "#simple_search_click" ).show( );
        $( "#advanced_search_click" ).hide( );
        $( "#advanced_open" ).val( 'true' );
    }

    $( "#advanced_search_click" ).click( function ( ){
        $( "#advanced_search" ).show( );
        $( '#simple_search' ).hide( );
        $( "#simple_search_click" ).show( );
        $( "#advanced_search_click" ).hide( );
        $( "#advanced_open" ).val( 'true' );
    } );
    $( "#simple_search_click" ).click( function ( ){
        $( "#advanced_search" ).hide( );
        $( '#simple_search' ).show( );
        $( "#advanced_search_click" ).show( );
        $( "#simple_search_click" ).hide( );
        $( "#advanced_open" ).val( 'false' );
    } );

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
    $( ".dateField" ).datepicker( {
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd',
        yearRange: '1614:2015'
    } );
    $( "#datepicker" ).datepicker( "option", "dateFormat", $( this ).val( ) );

    /**
     * date slider
     * @type String|String|String
     */
    var date_from = "";
    var date_to = "";
    getParameterByName( "date_from" ) === "" ? date_from = "1614-01-01" : date_from = getParameterByName( "date_from" );
    getParameterByName( "date_to" ) === "" ? date_to = new Date( ) : date_to = getParameterByName( "date_to" );
    var dateSlider = document.getElementById( 'slider' );
    noUiSlider.create( dateSlider, {
        // Create two timestamps to define a range.
        range: {
            min: timestamp( '1614' ),
            max: timestamp( new Date( ) )
        },
        connect: true,
        // Steps of one week
        step: 7 * 24 * 60 * 60 * 1000,
        // Two more timestamps indicate the handle starting positions.
        start: [ timestamp( date_from ), timestamp( date_to ) ],
        // No decimals
        format: wNumb( {
            decimals: 0
        } )
    } );
    var dateValues = [
        document.getElementById( 'date_from_label' ),
        document.getElementById( 'date_to_label' )
    ];
    dateSlider.noUiSlider.on( 'update', function ( values, handle ){
        dateValues[handle].innerHTML = formatDate( new Date( +values[handle] ) );
        $( '#date_from' ).val( $( '#date_from_label' ).text( ) );
        $( '#date_to' ).val( $( '#date_to_label' ).text( ) );
        $( '#date_from_display' ).text( getYearFromDate( $( '#date_from_label' ).text( ) ) );
        $( '#date_to_display' ).text( getYearFromDate( $( '#date_to_label' ).text( ) ) );
    } );
} );

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

