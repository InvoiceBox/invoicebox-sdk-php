<?php

namespace Invoicebox\Sdk;

use JMS\Serializer\SerializerInterface;

class JsonSerializer
{
    private const JSON_TYPE = 'json';

    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @return mixed
     */
    public function deserialize(string $data, string $class)
    {
        return $this->serializer->deserialize($data, $class, self::JSON_TYPE);
    }

    /**
     * @param object|array $object
     */
    public function serialize($object): string
    {
        return $this->serializer->serialize($object, self::JSON_TYPE);
    }
}
