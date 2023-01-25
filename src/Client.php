<?php
declare(strict_types=1);

namespace Comgate;

use Comgate\Request\RequestInterface;
use Comgate\Response\ResponseInterface;

use GuzzleHttp\Client as HttpClient;

class Client
{
    /**
     * @var string
     */
    private $merchantId;

    /**
     * @var bool
     */
    private $test;

    /**
     * @var null|string
     */
    private $secret;

    /**
     * @var HttpClient
     */
    private $client;


    /**
     * @param string      $merchantId
     * @param bool        $test   (use test env)
     * @param string|null $secret (if not set you cannot create transaction in background)
     */
    public function __construct(string $merchantId, bool $test = false, string $secret = null)
    {
        $this->merchantId = $merchantId;
        $this->test       = $test;
        $this->secret     = $secret;

        $this->client = new HttpClient([
            'base_uri' => 'https://payments.comgate.cz/v1.0/'
        ]);
    }


    /**
     * @param HttpClient $client
     * @return $this
     */
    public function setClient(HttpClient $client): self
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Comgate\Exception\ErrorCodeException
     * @throws \Comgate\Exception\InvalidArgumentException
     */
    public function send(RequestInterface $request)
    {
        $baseParams = [
            'merchant' => $this->merchantId,
            'test' => $this->test ? 'true' : 'false',
            'secret' => $this->secret
        ];

        if ($request->isPost()) {
            $response = $this->client->request('POST', $request->getEndPoint(), [
                'form_params' => $baseParams + $request->getData()
            ]);
        } else {
            $response = $this->client->request('GET', $request->getEndPoint(), [
                'query' => $baseParams + $request->getData()
            ]);
        }

        $body = (string) $response->getBody();

        return $request->getResponseObject($body);
    }
}
