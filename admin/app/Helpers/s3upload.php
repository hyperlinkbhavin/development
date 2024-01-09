<?php

namespace App\Helpers;

use Cookie;
// use Illuminate\Support\Facades\Storage;

use AWS\S3\Exception\S3Exception;
use Aws\S3\S3Client;

class s3upload
{

  // public function __construct(){
  //     parent::__construct();

  // }

  public static function uploadImage($file_name, $tmp_name, $bucket_path)
  {

    $image_path = time() . $file_name;
    // dd($image_path);

    try {
      $s3Client = new S3Client([
        'region'  => env('AWS_DEFAULT_REGION'),
        'version' => 'latest',
        'credentials' => [
          'key'    => env('AWS_ACCESS_KEY_ID'),
          'secret' => env('AWS_SECRET_ACCESS_KEY'),
        ]
      ]);
// dd($tmp_name );
// dd(env('AWS_BUCKET'));
// dd($bucket_path);
// dd( $image_path);
// dd($tmp_name);
      $s3Client->putObject([
        'Bucket' => env('AWS_BUCKET'),
        'Key'    => $bucket_path . $image_path,
        'SourceFile' => ($tmp_name != "") ? $tmp_name : '',
        'ACL'    => 'public-read',
      ]);
      return $image_path;
    } catch (S3Exception $e) {

      echo "There was an error uploading the file.\n";
    }
  }
}
