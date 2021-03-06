<?php
namespace Jan\Component\FileSystem;


use Jan\Component\FileSystem\Exception\FileLocatorException;

/**
 * Class FileLocator
 * @package Jan\Component\FileSystem
*/
class FileLocator
{

      /**
       * @var string
      */
      protected $resourceDirectory;



      /**
       * FileLocator constructor.
       * @param string $resourceDirectory
      */
      public function __construct(string $resourceDirectory = '')
      {
             if($resourceDirectory) {
                 $this->localise($resourceDirectory);
             }
      }



      /**
       * @param string $resourceDirectory
      */
      public function localise(string $resourceDirectory)
      {
            $this->resourceDirectory = rtrim($resourceDirectory, '\\/');
      }



      /**
       * Generate full path of given filename
       *
       * @param string $filename
       * @return string
      */
      public function resource(string $filename)
      {
           return implode(DIRECTORY_SEPARATOR, [
             $this->resourceDirectory,
             $this->resolvePath($filename)
           ]);
      }



      public function resources(string $mask)
      {

      }



      /**
       * Determine if the given file exist
       *
       * @param string $filename
       * @return bool
      */
      public function exists(string $filename): bool
      {
          return file_exists($this->resource($filename));
      }


      /**
        * @param string $filename
        * @return mixed
      */
      public function load(string $filename)
      {
           if(! $this->exists($filename)) {
               return false;
           }

           return require $this->resource($filename);
      }


      /**
       * Resolve path
       *
       * @param string $filename
       * @return string
      */
      public function resolvePath(string $filename): string
      {
          $filename = $this->removeTrainingSlashes($filename);
          return str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $filename);
      }


      /**
       * @param string $path
       * @return string
      */
      public function removeTrainingSlashes(string $path): string
      {
          return trim($path, '\\/');
      }
}