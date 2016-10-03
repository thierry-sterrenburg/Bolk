<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Testdata extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //projects: id int(10)|regnumber varchar(255)|name varchar(255)|location varchar(255)|startdate datetime|enddate datetime|remarks longtext
        DB::table('projects')->insert(['regnumber' => '123456', 'name' => 'Windmill Nijverdal', 'location' => 'Nijverdal', 'startdate' => null, 'enddate' => null, 'remarks' => '' ]);
        DB::table('projects')->insert(['regnumber' => '321456', 'name' => 'Windmill Almelo', 'location' => 'Almelo', 'startdate' => null, 'enddate' => null, 'remarks' => '' ]);
        DB::table('projects')->insert(['regnumber' => '654321', 'name' => 'Windmill Enschede', 'location' => 'Enschede', 'startdate' => null, 'enddate' => null, 'remarks' => '' ]);
        DB::table('projects')->insert(['regnumber' => '456123', 'name' => 'Windmill Genderen', 'location' => 'Genderen', 'startdate' => null, 'enddate' => null, 'remarks' => '' ]);
        //windmills: id int(10)|projectid id(11)|regnumber varchar(255)|name varchar(255)|location varchar(255)|startdate datetime|enddate datetime|remarks longtex
        DB::table('windmills')->insert(['projectid' => '1', 'regnumber' => '123457', 'name' => 'T1', 'location' => 'Nijverdal', 'startdate' => null, 'enddate' => null, 'remarks' => '' ]);
        DB::table('windmills')->insert(['projectid' => '1', 'regnumber' => '123458', 'name' => 'T2', 'location' => 'Nijverdal', 'startdate' => null, 'enddate' => null, 'remarks' => '' ]);
        DB::table('windmills')->insert(['projectid' => '2', 'regnumber' => '321457', 'name' => 'T1', 'location' => 'Almelo', 'startdate' => null, 'enddate' => null, 'remarks' => '' ]);

        //components: id int(10)|projectid id(11)|windmillid int(255)|regnumber varchar(255)|name varchar(255)|LENGTH DOUBLE(8,2)|WIDTH DOUBLE(8,2)| HEIGHT DOUBLE(8,2)| WEIGth DOUBLE(8,2)|switchable varchar(255)|status enum|remarks longtex
        DB::table('components')->insert(['projectid' => '1', 'windmillid' => '1', 'regnumber' => '1234569', 'name' => 'PPM', 'length' => null, 'width' => null, 'height' => null, 'weigth' => null, 'switchable' => 'null', 'remarks' => '' ]);
        DB::table('components')->insert(['projectid' => '1', 'windmillid' => '1', 'regnumber' => '1234570', 'name' => 'Nacelle', 'length' => null, 'width' => null, 'height' => null, 'weigth' => null, 'switchable' => 'null', 'remarks' => '' ]);
        DB::table('components')->insert(['projectid' => '1', 'windmillid' => null, 'regnumber' => '1234570', 'name' => 'Nacelle', 'length' => null, 'width' => null, 'height' => null, 'weigth' => null, 'switchable' => 'null', 'remarks' => '' ]);

        //transport: id int(10)|componentid int(11)|transportnumber varchar(255)|company varchar(255)|truck varchar(255)|trailer varchar(255)|configuration varchar(255)|from varchar(255)|to varchar(255)|dateofloading datetime|  dateofarrivalinitial datetime|dateofarrivalfinal datetime|remarks longtex
        DB::table('transports')->insert(['componentid' => '1', 'transportnumber' => '510', 'company' => 'Lubbers', 'truck' => 'Lubbers', 'trailer' => 'LB410', 'configuration' => null, 'from' => 'Spelle', 'to' => 'Nijverdal', 'dateofloading' => '2008-01-01 00:00:00', 'dateofarrivalinitial' => '2008-02-01 00:00:00', 'dateofarrivalfinal' => '2008-02-02 00:00:00', 'remarks' => '' ]);
        DB::table('transports')->insert(['componentid' => '1', 'transportnumber' => '520', 'company' => 'Lubbers', 'truck' => 'Lubbers', 'trailer' => 'LB410', 'configuration' => null, 'from' => 'Spelle', 'to' => 'Nijverdal', 'dateofloading' => '2008-02-01 00:00:00', 'dateofarrivalinitial' => '2008-03-01 00:00:00', 'dateofarrivalfinal' => '2008-03-04 00:00:00', 'remarks' => '' ]);
        DB::table('transports')->insert(['componentid' => '1', 'transportnumber' => '530', 'company' => 'Lubbers', 'truck' => 'Lubbers', 'trailer' => 'LB410', 'configuration' => null, 'from' => 'Spelle', 'to' => 'Nijverdal', 'dateofloading' => '2008-03-01 00:00:00', 'dateofarrivalinitial' => '2008-04-01 00:00:00', 'dateofarrivalfinal' => '2008-04-06 00:00:00', 'remarks' => '' ]);
        DB::table('transports')->insert(['componentid' => '1', 'transportnumber' => '540', 'company' => 'Lubbers', 'truck' => 'Lubbers', 'trailer' => 'LB410', 'configuration' => null, 'from' => 'Spelle', 'to' => 'Nijverdal', 'dateofloading' => '2009-01-01 00:00:00', 'dateofarrivalinitial' => '2009-03-01 00:00:00', 'dateofarrivalfinal' => '2009-04-01 00:00:00', 'remarks' => '' ]);
        DB::table('transports')->insert(['componentid' => '2', 'transportnumber' => '511', 'company' => 'Lubbers', 'truck' => 'Lubbers', 'trailer' => 'LB410', 'configuration' => null, 'from' => 'Spelle', 'to' => 'Nijverdal', 'dateofloading' => null, 'dateofarrivalinitial' => null, 'dateofarrivalfinal' => null, 'remarks' => '' ]);


        //requirements: id int(10)|transportid int(11)|name varchar(255)|country varchar(255)|startdate datetime|enddate datetime|booked enum|responsibleplanner varchar(255)|remarks longtext
        DB::table('requirements')->insert(['transportid' => '1', 'name' => 'permit', 'country' => 'Netherlands', 'startdate' => '2008-01-01 00:00:00', 'enddate' => '2008-02-01 00:00:00', 'booked' => 'pending', 'responsibleplanner' => 'Henk de Vries', 'remarks' => '']);
        DB::table('requirements')->insert(['transportid' => '1', 'name' => 'police escort', 'country' => 'Netherlands', 'startdate' => '2009-01-01 00:00:00', 'enddate' => '2009-02-01 00:00:00', 'booked' => 'no', 'responsibleplanner' => 'Henk de Vries', 'remarks' => '']);        
        DB::table('requirements')->insert(['transportid' => '1', 'name' => 'overslagverguning', 'country' => 'Duitsland', 'startdate' => '2010-01-01 00:00:00', 'enddate' => '2010-02-01 00:00:00', 'booked' => 'yes', 'responsibleplanner' => 'Johannes van Bergen', 'remarks' => '']);

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
