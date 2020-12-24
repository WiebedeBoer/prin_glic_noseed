<div class="sub-menu">
<nav class="navbar navbar-expand-lg">
    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
 <!--apps sub-->
    <div class="container">
        <div class="links"> 
        <div class="single-demo-wrap">
        <ul class="nav navbar-nav" id="master-menu-clickonly">   
            <li class="li-with-ul"><span class="slight-submenu-button" onclick="openApps()"><img src="{{ asset('assets/images/arrow-down-black.png') }}" onclick="openApps()"></span> 
                <a href="/apps">Apps</a> 
              
                <ul class="slight-submenu-ul" id="openapps">
                    <li><a href="/apps">Apps lijst</a></li>
                    <li><a href="/appstatus">App status lijst</a></li>
                    <li><a href="/serverapps">Servers en Apps lijst</a></li>
                </ul>
            </li>
            <li class="li-with-ul"><span class="slight-submenu-button" onclick="openDependencies()"><img src="{{ asset('assets/images/arrow-down-black.png') }}" onclick="openDependencies()"></span>  
                <a href="/appdependencies">Afhankelijkheden</a> 
                     
                <ul class="slight-submenu-ul" id="opendependencies"> 
                    <li><a href="/appdependencies">App Koppelingen lijst</a></li> 
                    <li><a href="/languages">Language Dependencies lijst</a></li>   
                    <li><a href="/frameworks">Framework Dependencies lijst</a></li>
                    <li><a href="/databases">Database Dependencies lijst</a></li>   
                    <li><a href="/libraries">Library Afhankelijkheden lijst</a></li>
                    <li><a href="/librarydependencies">Afhankelijkheden binnen Library lijst</a></li>     
                </ul>
            </li>
            <li class="li-with-ul"><span class="slight-submenu-button" onclick="openPersons()"><img src="{{ asset('assets/images/arrow-down-black.png') }}" onclick="openPersons()"></span> 
                <a href="/persons">Personen</a> 
                 
                <ul class="slight-submenu-ul" id="openpersons">
                    <li><a href="/persons">Contactpersonen lijst</a></li>  
                    <li><a href="/appowner">App eigenaar lijst</a></li>
                    <li><a href="/apptechadmin">App technisch beheerder lijst</a></li>   
                    <li><a href="/appfunctionaladmin">App functioneel beheerder lijst</a></li>       
                </ul>
                <li><a href="/search">Zoeken</a></li> 
            </ul> 
        </div>
        </div>           
    </div>



</div>      

    
</nav>
</div>