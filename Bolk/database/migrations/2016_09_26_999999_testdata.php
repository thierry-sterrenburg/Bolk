<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Role;
use App\User;
use App\Permission;

class Testdata extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //projects: id int(10)|regnumber varchar(255)|name varchar(255)|location varchar(255)|startdate date|enddate date|remarks longtext
        DB::table('projects')->insert(['regnumber' => '123456', 'name' => 'Project Nijverdal', 'location' => 'Nijverdal', 'startdate' => null, 'enddate' => null, 'remarks' => '' ]);
        DB::table('projects')->insert(['regnumber' => '321456', 'name' => 'Project Almelo', 'location' => 'Almelo', 'startdate' => null, 'enddate' => null, 'remarks' => '' ]);
        DB::table('projects')->insert(['regnumber' => '654321', 'name' => 'Project Enschede', 'location' => 'Enschede', 'startdate' => null, 'enddate' => null, 'remarks' => '' ]);
        DB::table('projects')->insert(['regnumber' => '456123', 'name' => 'Project Genderen', 'location' => 'Genderen', 'startdate' => null, 'enddate' => null, 'remarks' => '' ]);
       
        DB::table('projects')->insert(['regnumber' => '1', 'name' => 'Project GE Test', 'location' => 'Wieringswerf', 'startdate' => '2016-10-20', 'enddate' => '2016-12-02', 'remarks' => '']);
        //windmills: id int(10)|projectid id(11)|regnumber varchar(255)|name varchar(255)|location varchar(255)|startdate datetime|enddate datetime|remarks longtex
        DB::table('windmills')->insert(['projectid' => '1', 'regnumber' => '123457', 'name' => 'T1', 'location' => 'Nijverdal', 'startdate' => null, 'enddate' => null, 'remarks' => '' ]);
        DB::table('windmills')->insert(['projectid' => '1', 'regnumber' => '123458', 'name' => 'T2', 'location' => 'Nijverdal', 'startdate' => null, 'enddate' => null, 'remarks' => '' ]);
        DB::table('windmills')->insert(['projectid' => '2', 'regnumber' => '321457', 'name' => 'T1', 'location' => 'Almelo', 'startdate' => null, 'enddate' => null, 'remarks' => '' ]);
      
        DB::table('windmills')->insert(['projectid' => '5', 'regnumber' => '12', 'name' => 'T1', 'location' => 'Wieringswerf', 'startdate' => '2016-10-23', 'enddate' => '2016-12-02', 'remarks' => '']);
        DB::table('windmills')->insert(['projectid' => '5', 'regnumber' => '13', 'name' => 'T2', 'location' => 'Wieringswerf', 'startdate' => '2016-10-23', 'enddate' => '2016-12-02', 'remarks' => '']);

        //components: id int(10)|projectid id(11)|windmillid int(255)|regnumber varchar(255)|name varchar(255)|LENGTH DOUBLE(8,2)|WIDTH DOUBLE(8,2)| HEIGHT DOUBLE(8,2)| WEIGht DOUBLE(8,2)| currecntlocation varchar(255)|status enum|remarks longtex
        DB::table('components')->insert(['projectid' => '1', 'mainwindmillid' => '1', 'regnumber' => '1234569', 'name' => 'PPM', 'length' => null, 'width' => null, 'height' => null, 'weight' => null,'currentlocation'=>'nijverdal', 'remarks' => '' ]);
        DB::table('components')->insert(['projectid' => '1', 'mainwindmillid' => '1', 'regnumber' => '1234570', 'name' => 'Nacelle', 'length' => null, 'width' => null, 'height' => null, 'weight' => null, 'currentlocation'=>'nijverdal', 'remarks' => '' ]);
        DB::table('components')->insert(['projectid' => '1', 'mainwindmillid' => null, 'regnumber' => '1234570', 'name' => 'Nacelle', 'length' => null, 'width' => null, 'height' => null, 'weight' => null, 'currentlocation'=>'nijverdal', 'remarks' => '' ]);
       
        DB::table('components')->insert(['projectid' => '5', 'mainwindmillid' => null, 'regnumber' => '101', 'name' => 'Nacelle', 'length' => null, 'width' => null, 'height' => null, 'weight' => null, 'currentlocation' => 'wordnietmeerweergeven', 'status' => 'unknown', 'remarks' => '']);
        DB::table('components')->insert(['projectid' => '5', 'mainwindmillid' => '4', 'regnumber' => '121', 'name' => 'Nacelle', 'length' => null, 'width' => null, 'height' => null, 'weight' => null, 'currentlocation' => 'wordnietmeerweergeven', 'status' => 'unknown', 'remarks' => '']);
        DB::table('components')->insert(['projectid' => '5', 'mainwindmillid' => '4', 'regnumber' => '122', 'name' => 'PPM', 'length' => null, 'width' => null, 'height' => null, 'weight' => null, 'currentlocation' => 'wordnietmeerweergeven', 'status' => 'unknown', 'remarks' => '']);
        DB::table('components')->insert(['projectid' => '5', 'mainwindmillid' => '4', 'regnumber' => '123', 'name' => 'Blade 1', 'length' => null, 'width' => null, 'height' => null, 'weight' => null, 'currentlocation' => 'wordnietmeerweergeven', 'status' => 'unknown', 'remarks' => '']);
        DB::table('components')->insert(['projectid' => '5', 'mainwindmillid' => '4', 'regnumber' => '124', 'name' => 'Blade 2', 'length' => null, 'width' => null, 'height' => null, 'weight' => null, 'currentlocation' => 'wordnietmeerweergeven', 'status' => 'unknown', 'remarks' => '']);
        DB::table('components')->insert(['projectid' => '5', 'mainwindmillid' => '4', 'regnumber' => '125', 'name' => 'Blade 3', 'length' => null, 'width' => null, 'height' => null, 'weight' => null, 'currentlocation' => 'wordnietmeerweergeven', 'status' => 'unknown', 'remarks' => '']);
        DB::table('components')->insert(['projectid' => '5', 'mainwindmillid' => '5', 'regnumber' => '133', 'name' => 'Blade 1', 'length' => null, 'width' => null, 'height' => null, 'weight' => null, 'currentlocation' => 'wordnietmeerweergeven', 'status' => 'unknown', 'remarks' => '']);
        DB::table('components')->insert(['projectid' => '5', 'mainwindmillid' => '5', 'regnumber' => '134', 'name' => 'Blade 2', 'length' => null, 'width' => null, 'height' => null, 'weight' => null, 'currentlocation' => 'wordnietmeerweergeven', 'status' => 'unknown', 'remarks' => '']);
        DB::table('components')->insert(['projectid' => '5', 'mainwindmillid' => '5', 'regnumber' => '135', 'name' => 'Blade 3', 'length' => null, 'width' => null, 'height' => null, 'weight' => null, 'currentlocation' => 'wordnietmeerweergeven', 'status' => 'unknown', 'remarks' => '']);

        //transport: id int(10)|projectid int(10)|transportnumber varchar(255)|company varchar(255)|truck varchar(255)|trailer varchar(255)|configuration varchar(255)|from varchar(255)|to varchar(255)|loadingdate datetime|  datedesired datetime|dateestimated datetime| dateplanned datetime| dateactual datetime|remarks longtex
        DB::table('transports')->insert(['projectid' => '1','transportnumber' => '510', 'company' => 'Lubbers', 'truck' => 'Lubbers', 'trailer' => 'LB410', 'configuration' => null, 'from' => 'Spelle', 'to' => 'Nijverdal', 'loadingdate' => '2008-01-29', 'datedesired' => '2008-02-01', 'dateestimated' => null, 'dateplanned'=> null, 'dateactual' => '2008-02-02', 'unloadingdate'=> '2008-02-02', 'remarks' => '' ]);
        DB::table('transports')->insert(['projectid' => '1','transportnumber' => '520', 'company' => 'Lubbers', 'truck' => 'Lubbers', 'trailer' => 'LB410', 'configuration' => null, 'from' => 'Spelle', 'to' => 'Nijverdal', 'loadingdate' => '2008-02-01', 'datedesired' => '2008-03-01', 'dateestimated' => null, 'dateplanned'=> null, 'dateactual' => '2008-03-04', 'unloadingdate'=> null, 'remarks' => '' ]);
        DB::table('transports')->insert(['projectid' => '1','transportnumber' => '530', 'company' => 'Lubbers', 'truck' => 'Lubbers', 'trailer' => 'LB410', 'configuration' => null, 'from' => 'Spelle', 'to' => 'Nijverdal', 'loadingdate' => '2008-03-01', 'datedesired' => '2008-04-01', 'dateestimated' => null, 'dateplanned'=> null, 'dateactual' => '2008-04-06', 'unloadingdate'=> null, 'remarks' => '' ]);
        DB::table('transports')->insert(['projectid' => '1','transportnumber' => '540', 'company' => 'Lubbers', 'truck' => 'Lubbers', 'trailer' => 'LB410', 'configuration' => null, 'from' => 'Spelle', 'to' => 'Nijverdal', 'loadingdate' => '2009-01-01', 'datedesired' => '2009-03-01', 'dateestimated' => null, 'dateplanned'=> null, 'dateactual' => '2009-04-01', 'unloadingdate'=> null, 'remarks' => '' ]);
        DB::table('transports')->insert(['projectid' => '1','transportnumber' => '511', 'company' => 'Lubbers', 'truck' => 'Lubbers', 'trailer' => 'LB410', 'configuration' => null, 'from' => 'Spelle', 'to' => 'Nijverdal', 'loadingdate' => null, 'datedesired' => '2010-01-01', 'dateestimated' => null, 'dateplanned'=> null, 'dateactual' => null, 'unloadingdate'=> null, 'remarks' => '' ]);

        DB::table('transports')->insert(['projectid' => '5','transportnumber' => '501', 'company' => 'Lubbers', 'truck' => 'Lubbers', 'trailer' => 'LB410', 'configuration' => null, 'from' => 'Spelle', 'to' => 'Almelo', 'loadingdate' => '2016-10-28', 'datedesired' => '2016-10-29', 'dateestimated' => '2016-10-29', 'dateplanned'=> '2016-10-29', 'dateactual' => '2016-10-29', 'unloadingdate'=> '2016-10-30', 'remarks' => '' ]);
        DB::table('transports')->insert(['projectid' => '5','transportnumber' => '502', 'company' => 'Lubbers', 'truck' => 'Lubbers', 'trailer' => 'LB411', 'configuration' => null, 'from' => 'Almelo', 'to' => 'Wieringswerf', 'loadingdate' => '2016-10-30', 'datedesired' => '2016-10-31', 'dateestimated' => '2016-10-30', 'dateplanned'=> '2016-10-30', 'dateactual' => '2016-11-01', 'unloadingdate'=> '2016-11-01', 'remarks' => '' ]);


        //component_transports: componentid int(10) | transportid int(10)
        DB::table('component_transports')->insert(['componentid' => '1', 'transportid' => '1']);
        DB::table('component_transports')->insert(['componentid' => '1', 'transportid' => '2']);
        DB::table('component_transports')->insert(['componentid' => '1', 'transportid' => '3']);
        DB::table('component_transports')->insert(['componentid' => '1', 'transportid' => '4']);
        DB::table('component_transports')->insert(['componentid' => '2', 'transportid' => '5']);

        DB::table('component_transports')->insert(['componentid' => '4', 'transportid' => '6']);
        DB::table('component_transports')->insert(['componentid' => '5', 'transportid' => '6']);
        DB::table('component_transports')->insert(['componentid' => '5', 'transportid' => '7']);

        //switchabels: componetid int(10)|windmillid int(10)
        DB::table('switchables')->insert(['componentid' => '3', 'windmillid' => '1']);

        DB::table('switchables')->insert(['componentid' => '7', 'windmillid' => '4']);
        DB::table('switchables')->insert(['componentid' => '7', 'windmillid' => '5']);
        DB::table('switchables')->insert(['componentid' => '10', 'windmillid' => '4']);
        DB::table('switchables')->insert(['componentid' => '10', 'windmillid' => '5']);

        //requirements: id int(10)|transportid int(11)|name varchar(255)|country varchar(255)|startdate datetime|enddate datetime|booked enum|responsibleplanner varchar(255)|remarks longtext
        DB::table('requirements')->insert(['transportid' => '1', 'name' => 'permit', 'country' => 'Netherlands', 'startdate' => '2008-01-01', 'enddate' => '2008-02-01', 'booked' => 'pending', 'responsibleplanner' => 'Henk de Vries', 'remarks' => '']);
        DB::table('requirements')->insert(['transportid' => '1', 'name' => 'police escort', 'country' => 'Netherlands', 'startdate' => '2009-01-01', 'enddate' => '2009-02-01', 'booked' => 'no', 'responsibleplanner' => 'Henk de Vries', 'remarks' => '']);
        DB::table('requirements')->insert(['transportid' => '1', 'name' => 'overslagverguning', 'country' => 'Duitsland', 'startdate' => '2010-01-01', 'enddate' => '2010-02-01', 'booked' => 'yes', 'responsibleplanner' => 'Johannes van Bergen', 'remarks' => '']);

        DB::table('requirements')->insert(['transportid' => '6', 'name' => 'permit', 'country' => 'Netherlands', 'startdate' => '2016-10-20', 'enddate' => '2017-10-20', 'booked' => 'yes', 'responsibleplanner' => 'Henk de Vries', 'remarks' => '']);
        DB::table('requirements')->insert(['transportid' => '6', 'name' => 'permit', 'country' => 'Germany', 'startdate' => '2016-10-20', 'enddate' => '2017-10-20', 'booked' => 'yes', 'responsibleplanner' => 'Henk de Vries', 'remarks' => '']);
        DB::table('requirements')->insert(['transportid' => '6', 'name' => 'police escort', 'country' => 'Germany', 'startdate' => '2016-10-29', 'enddate' => '2016-10-29', 'booked' => 'pending', 'responsibleplanner' => 'Henk de Vries', 'remarks' => '']);
        DB::table('requirements')->insert(['transportid' => '7', 'name' => 'police escort', 'country' => 'Netherlands', 'startdate' => '2016-10-31', 'enddate' => '2016-10-31', 'booked' => 'no', 'responsibleplanner' => 'Henk de Vries', 'remarks' => '']);



        DB::table('users')->insert(['name' => 'admin', 'fullname' => 'Administrator', 'email' => 'admin@bolk.com', 'password' => bcrypt('secret'),]);
        DB::table('users')->insert(['name' => 'planner', 'fullname' => 'Planner', 'email' => 'planner@bolk.com', 'password' => bcrypt('secret'),]);
        DB::table('users')->insert(['name' => 'customer', 'fullname' => 'Customer', 'email' => 'customer@bolk.com', 'password' => bcrypt('secret'),]);
        DB::table('users')->insert(['name' => 'ge', 'fullname' => 'General Electric', 'email' => 'info@ge.com', 'password' => bcrypt('geisawesome'), 'projectid' => '1']);

        $admin = new Role();
        $admin -> name = 'admin';
        $admin -> display_name = 'Administrator';
        $admin -> save();
        $planner = new Role();
        $planner -> name = 'planner';
        $planner -> display_name = 'Planner';
        $planner -> save();
        $customer = new Role();
        $customer -> name = 'customer';
        $customer -> display_name = 'Customer';
        $customer -> save();
        $ge = new Role();
        $ge -> name = 'ge';
        $ge -> display_name = 'General Electric';
        $ge -> save();

        $user = User::where('name', '=', 'admin')->first();
        $user->attachRole($admin);
        $user = User::where('name', '=', 'planner')->first();
        $user->attachRole($planner);
        $user = User::where('name', '=', 'customer')->first();
        $user->attachRole($customer);
        $user = User::where('name', '=', 'ge')->first();
        $user->attachRole($customer);

        for($i=5; $i < 100; $i++) {
            $r = new Role();
            $r->name = $i;
            $r->save();
        }

        $createProject = new Permission(); $createProject -> name = 'create-project'; $createProject -> display_name = 'Create Projects'; $createProject -> save();
        $readProject = new Permission(); $readProject -> name = 'read-project'; $readProject -> display_name = 'Read Projects'; $readProject -> save();
        $editProject = new Permission(); $editProject -> name = 'edit-project'; $editProject -> display_name = 'Edit Projects'; $editProject -> save();
        $deleteProject = new Permission(); $deleteProject -> name = 'delete-project'; $deleteProject -> display_name = 'Delete Projects'; $deleteProject -> save();

        $createWindmill = new Permission(); $createWindmill -> name = 'create-windmill'; $createWindmill -> display_name = 'Create Windmill'; $createWindmill -> save();
        $readWindmill = new Permission(); $readWindmill -> name = 'read-windmill'; $readWindmill -> display_name = 'Read Windmill'; $readWindmill -> save();
        $editWindmill = new Permission(); $editWindmill -> name = 'edit-windmill'; $editWindmill -> display_name = 'Edit Windmill'; $editWindmill -> save();
        $deleteWindmill = new Permission(); $deleteWindmill -> name = 'delete-windmill'; $deleteWindmill -> display_name = 'Delete Windmill'; $deleteWindmill -> save();

        $createTransport = new Permission(); $createTransport -> name = 'create-transport'; $createTransport -> display_name = 'Create Transports'; $createTransport -> save();
        $readTransport = new Permission(); $readTransport -> name = 'read-transport'; $readTransport -> display_name = 'Read Transports'; $readTransport -> save();
        $editTransport = new Permission(); $editTransport -> name = 'edit-transport'; $editTransport -> display_name = 'Edit Transports'; $editTransport -> save();
        $deleteTransport = new Permission(); $deleteTransport -> name = 'delete-transport'; $deleteTransport -> display_name = 'Delete Transports'; $deleteTransport -> save();

        $createComponent = new Permission(); $createComponent -> name = 'create-component'; $createComponent -> display_name = 'Create Components'; $createComponent -> save();
        $readComponent = new Permission(); $readComponent -> name = 'read-component'; $readComponent -> display_name = 'Read Components'; $readComponent -> save();
        $editComponent = new Permission(); $editComponent -> name = 'edit-component'; $editComponent -> display_name = 'Edit Components'; $editComponent -> save();
        $deleteComponent = new Permission(); $deleteComponent -> name = 'delete-component'; $deleteComponent -> display_name = 'Delete Components'; $deleteComponent -> save();

        /**$viewTable = new Permission();
        $viewTable -> name = 'view-table';
        $viewTable -> display_name = 'View tables';
        $viewTable -> save();**/

        $admin->attachPermissions(array($createProject,$readProject,$editProject,$deleteProject,$createWindmill,$readWindmill,$editWindmill,$deleteWindmill,$createTransport,$readTransport,$editTransport,$deleteTransport,$createComponent,$readComponent,$editComponent,$deleteComponent));
        $planner->attachPermissions(array($createProject,$readProject,$editProject,$deleteProject,$createWindmill,$readWindmill,$editWindmill,$deleteWindmill,$createTransport,$readTransport,$editTransport,$deleteTransport,$createComponent,$readComponent,$editComponent,$deleteComponent));
        $customer->attachPermissions(array($readProject, $readWindmill,$readTransport,$readComponent));
        $ge->attachPermissions(array($readProject, $readWindmill,$readTransport,$readComponent));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
