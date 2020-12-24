<div class="sub-menu">
<nav class="navbar navbar-expand-lg">
    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
 <!--apps sub-->
    <div class="container">
        <div class="links"> 
            <ul class="nav navbar-nav" id="master-menu-clickonly">
            <li class="li-with-ul"><span class="slight-submenu-button" onclick="openApps()"><img src="{{ asset('assets/images/arrow-down-black.png') }}" onclick="openApps()"></span> 
            <a href="/appdependencies">App Koppelingen</a> 
                <ul class="slight-submenu-ul" id="openapps">
                    <li><a href="/appdependencies">App Koppelingen</a></li> 
                </ul>
            </li> 
            <li class="li-with-ul"><span class="slight-submenu-button" onclick="openDependencies()"><img src="{{ asset('assets/images/arrow-down-black.png') }}" onclick="openDependencies()"></span> 
            <a href="/languages">Dependencies</a>
                <ul class="slight-submenu-ul" id="opendependencies">     
                    <li><a href="/languages">Language Dependencies</a></li>   
                    <li><a href="/frameworks">Framework Dependencies</a></li>
                    <li><a href="/databases">Database Dependencies</a></li>
                </ul>
            </li> 
            <li class="li-with-ul"><span class="slight-submenu-button" onclick="openPersons()"><img src="{{ asset('assets/images/arrow-down-black.png') }}" onclick="openPersons()"></span> 
            <a href="/libraries">Library Dependencies</a>
                <ul class="slight-submenu-ul" id="openpersons">
                    <li><a href="/libraries">Library Afhankelijkheden</a></li>
                    <li><a href="/librarydependencies">Afhankelijkheden binnen Library</a></li> 
                </ul> 
            </li>                 
            </ul> 
        </div>           
    </div>

</div>      
    
</nav>
</div>