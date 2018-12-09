<?php

  declare(strict_types = 1);

  namespace Funivan\CabbageFramework\Http\Response\FileResponse;

  use Funivan\Gallery\FileStorage\File\FileInterface;
  use Funivan\CabbageFramework\Http\Response\Body\BodyInterface;
  use Funivan\CabbageFramework\Http\Response\Headers\Field;
  use Funivan\CabbageFramework\Http\Response\Headers\Headers;
  use Funivan\CabbageFramework\Http\Response\HeadersInterface;
  use Funivan\CabbageFramework\Http\Response\Plain\PlainBody;
  use Funivan\CabbageFramework\Http\Response\ResponseInterface;
  use Funivan\CabbageFramework\Http\Response\Status\ResponseStatus;
  use Funivan\CabbageFramework\Http\Response\StatusInterface;

  /**
   *
   */
  class FileResponse implements ResponseInterface {

    /**
     * @var FileInterface
     */
    private $file;

    /**
     * @var HeadersInterface
     */
    private $headers;


    /**
     * @param FileInterface $file
     * @param HeadersInterface $headers
     */
    private function __construct(FileInterface $file, HeadersInterface $headers) {
      $this->file = $file;
      $this->headers = $headers;
    }


    /**
     * @param FileInterface $image
     * @return ResponseInterface
     */
    public static function createViewable(FileInterface $image): ResponseInterface {
      return new self($image, new Headers([]));
    }


    /**
     * @param FileInterface $image
     * @return ResponseInterface
     */
    public static function createDownloadable(FileInterface $image): ResponseInterface {
      $headers = new Headers([
        new Field('Content-Disposition', 'attachment; filename=' . basename($image->path()->assemble())),
        new Field('Content-Description', ' File Transfer'),
        new Field('Content-Transfer-Encoding', ' binary'),
        new Field('Connection', ' Keep-Alive'),
        new Field('Expires', ' 0'),
        new Field('Cache-Control', ' must-revalidate, post-check=0, pre-check=0'),
        new Field('Pragma', ' public'),
      ]);
      return new self($image, $headers);
    }


    /**
     * @return StatusInterface
     */
    final public function status(): StatusInterface {
      return new ResponseStatus(200);
    }


    /**
     * @return HeadersInterface
     */
    final public function headers(): HeadersInterface {
      return (new Headers([
        new Field('Content-Type', (string) (new \Mimey\MimeTypes)->getMimeType($this->file->meta('extension'))),
      ]))->merge($this->headers);
    }


    /**
     * @todo make more effective image download
     *
     * @return BodyInterface
     */
    final public function body(): BodyInterface {
      return new PlainBody($this->file->read());
    }

  }