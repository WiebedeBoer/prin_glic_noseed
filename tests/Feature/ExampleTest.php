<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Supplier;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

     
    //test home
    public function testBasicTest()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /*
    public function testUser()
    {
        $user = factory(User::class)->create();
        return $user;
    }
    */

    /*
    //test logged in
    public function testLoggedInUnitTest()
    {
        $response = $this->get('/apps')->assertRedirect('/login');
    }  
    */ 

    //costs

    //test costs count apps
    public function testCostsCountAppsTest()
    {
        //$response = $this->action('GET', 'CostController@count_apps');
        //$this->assertEquals(53, $response);
        $apps_count = DB::table('apps')->count();
        $this->assertEquals(53, $apps_count);
    }  

    //test costs count servers
    public function testCostsCountServersTest()
    {
        //$response = $this->action('GET', 'CostController@count_servers');
        //$this->assertEquals(49, $response);
        $servers_count = DB::table('servers')->count();
        $this->assertEquals(49, $servers_count);
    }  

    //test costs count status
    public function testCostsCountStatusTest()
    {
        //$response = $this->action('GET', 'CostController@count_status');
        //$this->assertEquals(3, $response);
        $status_count = DB::table('server_status')->count();
        $this->assertEquals(3, $status_count);
    }  

    //test costs count service
    public function testCostsCountServiceTest()
    {
        //$response = $this->action('GET', 'CostController@server_service');
        //$this->assertEquals(4, $response);
        $service_count = DB::table('server_service')->count();
        $this->assertEquals(4, $service_count);
    }  

    
    //test costs sum server
    public function testCostsSumServerTest()
    {
        //$response = $this->action('GET', 'CostController@sum_server_costs');
        //$this->assertEquals(0, $response);
        $sum_server_costs = DB::table('servers')->sum('server_costs');
        $this->assertEquals(0, $sum_server_costs);
    }  

    //test costs sum memory
    public function testCostsSumMemoryTest()
    {
        //$response = $this->action('GET', 'CostController@sum_memory_costs');
        //$this->assertEquals(0, $response);
        $sum_memory_costs = DB::table('servers')->sum('memory_costs');
        $this->assertEquals(0, $sum_memory_costs);
    } 

    //test costs sum sla
    public function testCostsSumSlaTest()
    {
        //$response = $this->action('GET', 'CostController@sum_sla_costs');
        //$this->assertEquals(0, $response);
        $sum_sla_costs = DB::table('servers')->sum('sla_costs');
        $this->assertEquals(0, $sum_sla_costs);
    } 
    
    //cost views
    
    //test costs index
    public function testCostsIndexTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/costs');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }


    //test costs show
    public function testCostsShowTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/costs/1');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    //privacy views

    //privacy index
    public function testPrivacyIndexTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/privacy/1');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    // privacy show
    public function testPrivacyShowTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/privacy/1');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    // privacy edit
    public function testPrivacyEditTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/privacy/1/edit');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }
    
    

    //privacy

    
    //supplier count
    public function testPrivacyCountAppSupplierTest()
    {
        //$response = $this->action('GET', 'CostController@countAppSupplier');
        //$this->assertEquals(0, $response);
        $app_id = 1;
        $appsuppliercount = Supplier::where('app_id', $app_id)->count();
        $this->assertEquals(0, $appsuppliercount);
    } 
    

    
    //search views

    /*
    // search index
    public function testSearchIndexTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/search');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    // search show
    public function testSearchShowTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/search/show');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }
    */

    //apps views

    //apps index
    public function testAppsIndexTest()
    {
        $response = $this->get('/apps');
        $response->assertStatus(200);
    }

    
    //apps show
    public function testAppsShowTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/apps/1');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    // apps edit
    public function testAppsEditTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/apps/1/edit');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    // apps create
    public function testAppsCreateTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/apps/create');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }
    

    //appstatus views
    /*
    //appstatus index
    public function testAppstatusIndexTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/appstatus');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }
    */
    
    //appstatus show
    public function testAppstatusShowTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/appstatus/1');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    // appstatus edit
    public function testAppstatusEditTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/appstatus/1/edit');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    // appstatus create
    public function testAppstatusCreateTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/appstatus/create');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }
    

    /*
    // appstatus update
    public function testAppstatusUpdateTest()
    {
        $this->post(['app_status' => 'unit test']);
        $app_status = App_Status::first();
        $response = $this->patch('/appstatus/'.$app_status->app_status_id,['app_status' => 'new unit test']);
        $this->assertEquals('new unit test', App_Status::first()->app_status);
    }

    //appstatus store
    public function testAppstatusStoreTest()
    {
        $response = $this->post(['app_status' => 'unit test']);
        $response->assertOk();
        //$this->assertCount(1, App_Status::all());     
        $this->assertCount(1, App_Status::count());    
    }

    //appstatus destroy
    public function testAppstatusDestroyTest()
    {
        $this->withoutExceptionHandling();
        $this->post(['app_status' => 'unit test']);
        $app_status = App_Status::first();
        $response = $this->delete('/appstatus/'.$app_status->app_status_id);
        //$this->assertCount(0, App_Status::all());
        $this->assertCount(0, App_Status::count()); 
    }
    */

    
    //appdependencies views

    //appdependencies index
    public function testAppdependenciesIndexTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/appdependencies');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    /*
    //appdependencies show
    public function testAppdependenciesShowTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/appdependencies/1');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    //appdependencies edit
    public function testAppdependenciesEditTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/appdependencies/1/edit');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }
    */

    //appdependencies create
    public function testAppdependenciesCreateTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/appdependencies/create');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    //serverapps views

    // serverapps index
    public function testServerAppsIndexTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/serverapps');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    // serverapps show
    public function testServerAppsShowTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/serverapps/1');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    /*
    // serverapps edit
    public function testServerAppsEditTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/serverapps/1/edit');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }
    */

    //serverapps create
    public function testServerAppsCreateTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/serverapps/create');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    //servers views

    //servers index
    public function testServersIndexTest()
    {
        $response = $this->get('/servers');
        $response->assertStatus(200);
    }

    
    // servers show
    public function testServersShowTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/servers/1');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    // servers edit
    public function testServersEditTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/servers/1/edit');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    // servers create
    public function testServersCreateTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/servers/create');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }
    

    //serverotap views

    //serverotap index
    public function testServerotapIndexTest()
    {
        $response = $this->get('/serverotap');
        $response->assertStatus(200);
    }

    
    //serverotap show
    public function testServerotapShowTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/serverotap/1');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    /*
    // serverotap edit
    public function testServerotapEditTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/serverotap/1/edit');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }
    */

    // serverotap create
    public function testServerotapCreateTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/serverotap/create');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }
    

    //serverservice views

    //serverservice index
    public function testServerserviceIndexTest()
    {
        $response = $this->get('/serverservice');
        $response->assertStatus(200);
    }

    
    // serverservice show
    public function testServerserviceShowTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/serverservice/1');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    // serverservice edit
    public function testServerserviceEditTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/serverservice/1/edit');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    // serverservice create
    public function testServerserviceCreateTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/serverservice/create');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }
    

    //serverstatus views
    //serverstatus index
    public function testServerstatusIndexTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/serverstatus');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }


    // serverstatus show
    public function testServerstatusShowTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/serverstatus/1');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    //serverstatus edit
    public function testServerstatusEditTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/serverstatus/1/edit');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    // serverstatus create
    public function testServerstatusCreateTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/serverstatus/create');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    //servertype views

    //servertype index
    public function testServertypeIndexTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/servertype');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    //servertype show
    public function testServertypeShowTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/servertype/1');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    // servertype edit
    public function testServertypeEditTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/servertype/1/edit');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    // servertype create
    public function testServertypeCreateTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/servertype/create');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    //libraries views

    // libraries index
    public function testLibrariesIndexTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/libraries');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    /*
    // libraries show
    public function testLibrariesShowTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/libraries/1');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    //libraries edit
    public function testLibrariesEditTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/libraries/1/edit');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }
    */

    //libraries create
    public function testLibrariesCreateTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/libraries/create');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    //databases views

    /*
    //databases index
    public function testDatabasesIndexTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/databases');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }
    */

    // databases show
    public function testDatabasesShowTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/databases/1');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    // databases edit
    public function testDatabasesEditTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/databases/1/edit');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    // databases create
    public function testDatabasesCreateTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/databases/create');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    //frameworks views

    // frameworks index
    public function testFrameworksIndexTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/frameworks');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    /*
    // frameworks show
    public function testFrameworksShowTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/frameworks/1');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }
    */

    // frameworks edit
    public function testFrameworksEditTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/frameworks/1/edit');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    //frameworks create
    public function testFrameworksCreateTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/frameworks/create');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    //languages views

    // languages index
    public function testLanguagesIndexTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/languages');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    // languages show
    public function testLanguagesShowTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/languages/1');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    /*
    // languages edit
    public function testLanguagesEditTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/languages/1/edit');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    // languages create
    public function testLanguagesCreateTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/languages/create');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }
    */

    //hours views

    //hours index
    public function testHoursIndexTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/hours');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    // hours show
    public function testHoursShowTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/hours/1');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    // hours edit
    public function testHoursEditTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/hours/1/edit');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    // hours create
    public function testHoursCreateTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/hours/create');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    //hours archive
    public function testHoursArchiveTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/hours/archive');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    //calendar views

    // calendar index
    public function testCalendarIndexTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/calendar');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    /*
    //calendar show
    public function testCalendarShowTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/calendar/1');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }
    */

    //roadmaps views

    //roadmaps index
    public function testRoadmapsIndexTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/roadmaps');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    //roadmaps show
    public function testRoadmapsShowTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/roadmaps/1');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    /*
    // roadmaps edit
    public function testRoadmapsEditTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/roadmaps/1/edit');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    // roadmaps create
    public function testRoadmapsCreateTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/roadmaps/create');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }
    */

    //roadmap tasks views

    //roadmap tasks index
    public function testRoadmaptasksIndexTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/roadmaptasks');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    /*
    // roadmap tasks show
    public function testRoadmaptasksShowTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/roadmaptasks/1');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }
    */

    // roadmap tasks edit
    public function testRoadmaptasksEditTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/roadmaptasks/1/edit');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    //roadmap tasks create
    public function testRoadmaptasksCreateTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/roadmaptasks/create');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    //roadmap types views

    // roadmap types index
    public function testRoadmaptypesIndexTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/roadmaptypes');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    /*
    //roadmap types show
    public function testRoadmaptypesShowTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/roadmaptypes/1');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }
    */

    //roadmap types edit
    public function testRoadmaptypesEditTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/roadmaptypes/1/edit');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    //roadmap types create
    public function testRoadmaptypesCreateTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/roadmaptypes/create');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    //suppliers views

    // suppliers index
    public function testSuppliersIndexTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/suppliers');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    /*
    // suppliers show
    public function testSuppliersShowTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/suppliers/1');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    // suppliers edit
    public function testSuppliersEditTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/suppliers/1/edit');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }
    */

    // suppliers create
    public function testSuppliersCreateTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/suppliers/create');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    //techadmins views

    // techadmins index
    public function testTechadminsIndexTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/apptechadmin');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    /*
    // techadmins show
    public function testTechadminsShowTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/apptechadmin/1');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }
    */

    // techadmins edit
    public function testTechadminsEditTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/apptechadmin/1/edit');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    // techadmins create
    public function testTechadminsCreateTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/apptechadmin/create');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    //functionaladmins views

    //functionaladmins index
    /*
    public function testFunctionaladminsIndexTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/appfunctionaladmin');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }
    */

    // functionaladmins show
    public function testFunctionaladminsShowTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/appfunctionaladmin/1');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    //functionaladmins edit
    public function testFunctionaladminsEditTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/appfunctionaladmin/1/edit');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    // functionaladmins create
    public function testFunctionaladminsCreateTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/appfunctionaladmin/create');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    //owners views

    // owners index
    public function testOwnersIndexTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/appowner');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    //owners show
    public function testOwnersShowTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/appowner/1');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    //owners edit
    public function testOwnersEditTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/appowner/1/edit');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }

    //owners create
    public function testOwnersCreateTest()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->withSession(['Wiebe' => 'Wiebe'])->get('/appowner/create');
        $response->assertStatus(200);
        //delete user afterwards
        $id = $user->id;
        $deluser = User::findOrFail($id);
        $deluser->delete();
    }
    

}
