<?php
namespace Phrases\Http\Response;

use Zend\Http\Response;
use Zend\Http\Header\MultipleHeaderInterface;

/**
 * Send a response.
 *
 * @author Jefersson Nathan <malukenho@phpse.net>
 */
class Send
{
    /**
     * Send headers and output to main output channel.
     *
     * @param Response $response
     *
     * @return false|null
     */
    public static function response(Response $response)
    {
        if (headers_sent()) {
            return false;
        }

        foreach ($response->getHeaders() as $header) {
            if ($header instanceof MultipleHeaderInterface) {
                header($header->toString(), false);
                continue;
            }
            header($header->toString());
        }
        $status = $response->renderStatusLine();
        header($status);

        echo $response->getBody();
    }
}
