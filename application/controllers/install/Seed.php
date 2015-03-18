<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To run this on CLI
 * http://stevethomas.com.au/php/database-seeding-in-codeigniter.html
 * see php version: php -v
 * $ php index.php seed index
 */

class Seed extends CI_Controller {
	function __construct(){
		parent::__construct();

		// can only be called from the command line
		if (!is_cli()) {
			//redirect(base_url());
		}
 
		// can only be run in the development environment
		if (ENVIRONMENT !== 'development') {
			//exit('Wowsers! You don\'t want to do that!');
		}
 
		// initiate faker
		$this->faker = Faker\Factory::create();
 
		// load any required models
		$this->load->model('user');
	}
 
	/**
	* seed local database
	*/
	function index() {

		// migrate the database to the last version!
		$this->load->library('migration');
		$this->migration->latest();

		$number_of_users = 25;

		echo 'seeding: STARTING\n';
		echo PHP_EOL;

		// purge existing data
		$this->_truncate_db();
		echo 'seeding: DELETED TABLES\n';
		echo PHP_EOL;

		// seed users
		$this->_seed_users($number_of_users);
 
		echo 'seeding: DONE\n';
		echo PHP_EOL;

		redirect(base_url().'install/seed/users');
	}
 
	/**
	* seed users
	*
	* @param int $limit
	*/
	function _seed_users($limit) {
		echo "seeding: $limit USERS";
		// create a bunch of base user accounts
		for ($i = 0; $i < $limit; $i++) {
			echo ".";
			$now = new DateTime();
			if ($i == 0) {
				$data = array(
					'name' => 'Miguel Jesus',
					//'country' => $this->faker->country,
					//'registration_date' => $this->faker->dateTimeThisYear->format('Y-m-d H:i:s'),
					//'username' => 'miglrodri',
					'email' => 'miguel.jesus@tangivel.com',
					'hashed_pass' => sha1('1234567'),
					'created_at' => $now->format('Y-m-d H:i:s'),
					'modified_at' => $now->format('Y-m-d H:i:s'),
				);
			}
			else {
				$data = array(
					'name' => $this->faker->firstName . ' ' . $this->faker->lastName,
					//'country' => $this->faker->country,
					//'registration_date' => $this->faker->dateTimeThisYear->format('Y-m-d H:i:s'),
					//'username' => $this->faker->unique()->userName, // get a unique nickname
					'email' => $this->faker->email,
					'hashed_pass' => sha1('1234567'),
					'created_at' => $now->format('Y-m-d H:i:s'),
					'modified_at' => $now->format('Y-m-d H:i:s'),
				);	
			}

			$this->user->insert($data);
		}

		echo PHP_EOL;
	}
	
	private function _truncate_db()
	{
		$this->user->truncate();
	}

}