<?php

namespace AsyncAws\Athena\ValueObject;

/**
 * Contains session configuration information.
 */
final class SessionConfiguration
{
    /**
     * The ARN of the execution role used in a Spark session to access user resources. This property applies only to
     * Spark-enabled workgroups.
     *
     * @var string|null
     */
    private $executionRole;

    /**
     * The Amazon S3 location that stores information for the notebook.
     *
     * @var string|null
     */
    private $workingDirectory;

    /**
     * The idle timeout in seconds for the session.
     *
     * @var int|null
     */
    private $idleTimeoutSeconds;

    /**
     * @var EncryptionConfiguration|null
     */
    private $encryptionConfiguration;

    /**
     * @param array{
     *   ExecutionRole?: null|string,
     *   WorkingDirectory?: null|string,
     *   IdleTimeoutSeconds?: null|int,
     *   EncryptionConfiguration?: null|EncryptionConfiguration|array,
     * } $input
     */
    public function __construct(array $input)
    {
        $this->executionRole = $input['ExecutionRole'] ?? null;
        $this->workingDirectory = $input['WorkingDirectory'] ?? null;
        $this->idleTimeoutSeconds = $input['IdleTimeoutSeconds'] ?? null;
        $this->encryptionConfiguration = isset($input['EncryptionConfiguration']) ? EncryptionConfiguration::create($input['EncryptionConfiguration']) : null;
    }

    /**
     * @param array{
     *   ExecutionRole?: null|string,
     *   WorkingDirectory?: null|string,
     *   IdleTimeoutSeconds?: null|int,
     *   EncryptionConfiguration?: null|EncryptionConfiguration|array,
     * }|SessionConfiguration $input
     */
    public static function create($input): self
    {
        return $input instanceof self ? $input : new self($input);
    }

    public function getEncryptionConfiguration(): ?EncryptionConfiguration
    {
        return $this->encryptionConfiguration;
    }

    public function getExecutionRole(): ?string
    {
        return $this->executionRole;
    }

    public function getIdleTimeoutSeconds(): ?int
    {
        return $this->idleTimeoutSeconds;
    }

    public function getWorkingDirectory(): ?string
    {
        return $this->workingDirectory;
    }
}
