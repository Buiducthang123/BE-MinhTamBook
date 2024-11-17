<?php
namespace App\DTO\User;

readonly class UserCreateDTO
{
    private string $email;
    private string $password;
    private string $fullName;
    private ?string $companyName;
    private ?string $companyAddress;
    private ?string $companyPhoneNumber;
    private ?string $companyTaxCode;
    private ?string $contactPersonName;
    private ?string $representativeIdCard;
    private ?string $representativeIdCardDate;
    private ?string $contactPersonPosition;
    private string $roleId;
    private string $status;

    /**
     * Class constructor.
     */
    public function __construct(
        string $email,
        string $password,
        string $fullName,
        ?string $companyName,
        ?string $companyAddress,
        ?string $companyPhoneNumber,
        ?string $companyTaxCode,
        ?string $contactPersonName,
        ?string $representativeIdCard,
        ?string $representativeIdCardDate,
        ?string $contactPersonPosition,
        string $roleId,
        string $status
    ) {
        $this->email = $email;
        $this->password = $password;
        $this->fullName = $fullName;
        $this->companyName = $companyName;
        $this->companyAddress = $companyAddress;
        $this->companyPhoneNumber = $companyPhoneNumber;
        $this->companyTaxCode = $companyTaxCode;
        $this->contactPersonName = $contactPersonName;
        $this->representativeIdCard = $representativeIdCard;
        $this->representativeIdCardDate = $representativeIdCardDate;
        $this->contactPersonPosition = $contactPersonPosition;
        $this->roleId = $roleId;
        $this->status = $status;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getFullName(): string
    {
        return $this->fullName;
    }

    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    public function getCompanyAddress(): ?string
    {
        return $this->companyAddress;
    }

    public function getCompanyPhoneNumber(): ?string
    {
        return $this->companyPhoneNumber;
    }

    public function getCompanyTaxCode(): ?string
    {
        return $this->companyTaxCode;
    }

    public function getContactPersonName(): ?string
    {
        return $this->contactPersonName;
    }

    public function getRepresentativeIdCard(): ?string
    {
        return $this->representativeIdCard;
    }

    public function getRepresentativeIdCardDate(): ?string
    {
        return $this->representativeIdCardDate;
    }

    public function getContactPersonPosition(): ?string
    {
        return $this->contactPersonPosition;
    }

    public function getRoleId(): string
    {
        return $this->roleId;
    }

    public function getStatus(): string
    {
        return $this->status;
    }
}
