<?php

declare(strict_types=1);

namespace App\Services;

use AllowDynamicProperties;
use App\Enumerators\Permissions;
use App\Facades\Authenticator;
use App\Policies\UserPolicy;
use App\Reads\WireTransfer;
use App\Repository\TransferRepository;

#[AllowDynamicProperties] class TransferServices
{
    public function __construct(protected TransferRepository $transferRepository)
    {
        $this->userPolicy = new UserPolicy(Authenticator::user());
    }

    /** @throws \Throwable */
    public function transfer(array $attributes)
    {
        $wireTransfer = new WireTransfer($attributes);

        $this->userPolicy
            ->hasPermission(permission: Permissions::PAYER->value)
            ->hasBalance(value: $wireTransfer->value());


//Validar se o usuário tem saldo antes da transferência;
//Antes de finalizar a transferência, deve-se consultar um serviço autorizador externo, use este mock https://util.devi.tools/api/v2/authorize para simular o serviço utilizando o verbo GET;

//A operação de transferência deve ser uma transação (ou seja, revertida em qualquer caso de inconsistência) e o dinheiro deve voltar para a carteira do usuário que envia;
//No recebimento de pagamento, o usuário ou lojista precisa receber notificação (envio de email, sms) enviada por um serviço de terceiro e eventualmente este serviço pode estar indisponível/instável. Use este mock https://util.devi.tools/api/v1/notify)) para simular o envio da notificação utilizando o verbo POST;

        return $attributes;

    }
}
