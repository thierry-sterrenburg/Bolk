<?php

class UserTableSeeder extends Seeder {
  public function run() {
    DB::table('users')->delete();
    User::create(array(
      'name'      => 'Bolk1',
      'email'     => 'bolk@bolk.com',
      'password'  => Hash::make('secret')
    ));
  }
}

 ?>
