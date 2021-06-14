<?php

class User
{
    public $nama;
    public $email;
    public $dob;

    public function __construct($data)
    {
        $this->nama = $data['nama'];
        $this->email = $data['email'];
        $this->dob = $data['dob'];
    }
}

class UserRequest
{
    protected static $rules = [
        'nama' => 'string',
        'email' => 'string',
        'dob' => 'string'
    ];

    public static function validate($data){
        foreach (static::$rules as $property => $type){
            if (gettype($data[$property]) != $type){
                throw new \Exception("User property {$property} must be of type {$type}" );
            }
        }
    }
}

class Json{
    public static function from ($data){
        return json_encode($data);
    }
}

class umur{
    public static function sekarang($data){
        $dob = new DateTime($data['dob']);
        $today = new Datetime("today");
        if ($dob > $today){
        	exit("0 tahun 0 bulan 0 hari");
        }
        $y = $today->diff($dob)->y;
        $m = $today->diff($dob)->m;
        $d = $today->diff($dob)->d;
        return $y." tahun ".$m." bulan ".$d." hari";
    }
}

$data = [
    'nama' => 'Kholifatush_Sholichah', 
    'email' => 'kholifatush18@gmail.com',
    'dob' => '08.07.2001'
];

UserRequest::validate($data);
$user = new User($data);
print_r(Json::from($user));
echo '<br>';
echo("Usia : ");
print_r(umur::sekarang($data));
?>