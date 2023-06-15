<?php

use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed {
  public function run(): void {
    $data = array(
      array(
        'title' => 'fdsf1',
        'body'    => 'foo',
        'created_at' => date('Y-m-d H:i:s'),
      ),
      array(
        'title' => 'fdsf2',
        'body'    => 'bar',
        'created_at' => date('Y-m-d H:i:s'),
      )
    );

    $posts = $this->table('posts');
    $posts->insert($data)
      ->save();
  }
}
