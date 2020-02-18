<?php


namespace HttpConnect\HttpConnect\Example\TronaldDump\Quote\Transport;

use DateTimeImmutable;
use HttpConnect\HttpConnect\Transport\ResourceInterface;
use HttpConnect\HttpConnect\Transport\Traits\StringifiesAsJson;

class QuoteResource implements ResourceInterface
{
    use StringifiesAsJson;

    /**
     * @var string
     */
    private $quoteId;

    /**
     * @var string
     */
    private $value;

    /**
     * @var string[]
     */
    private $tags;

    /**
     * @var DateTimeImmutable
     */
    private $createdAt;

    /**
     * @var DateTimeImmutable
     */
    private $updatedAt;

    /**
     * @var DateTimeImmutable
     */
    private $appearedAt;

    /**
     * @var array
     */
    private $embedded;

    /**
     * @param string $quoteId
     * @param string $value
     * @param string[] $tags
     * @param DateTimeImmutable $createdAt
     * @param DateTimeImmutable $updatedAt
     * @param DateTimeImmutable $appearedAt
     * @param array $embedded
     */
    public function __construct(
        string $quoteId,
        string $value,
        array $tags,
        DateTimeImmutable $createdAt,
        DateTimeImmutable $updatedAt,
        DateTimeImmutable $appearedAt,
        array $embedded
    ) {
        $this->quoteId = $quoteId;
        $this->value = $value;
        $this->tags = $tags;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->appearedAt = $appearedAt;
        $this->embedded = $embedded;
    }

    /**
     * @return string
     */
    public function getQuoteId(): string
    {
        return $this->quoteId;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @return string[]
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getUpdatedAt(): DateTimeImmutable
    {
        return $this->updatedAt;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getAppearedAt(): DateTimeImmutable
    {
        return $this->appearedAt;
    }

    /**
     * @return array
     */
    public function getEmbedded(): array
    {
        return $this->embedded;
    }
}
