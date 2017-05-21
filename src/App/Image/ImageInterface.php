<?

  namespace Funivan\Gallery\App\Image;

  use Funivan\Gallery\FileStorage\File\FileInterface;
  use Funivan\Gallery\FileStorage\FileStorageInterface;


  /**
   *
   */
  interface ImageInterface {

    /**
     * @param FileStorageInterface $storage
     * @return FileInterface
     */
    public function preview(FileStorageInterface $storage): FileInterface;


    /**
     * @return FileInterface
     */
    public function original(): FileInterface;
  }