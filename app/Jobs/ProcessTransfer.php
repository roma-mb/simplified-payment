<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Exceptions\TransferException;
use App\Models\Wallet;
use App\Repository\TransferRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProcessTransfer implements ShouldQueue
{
    use Queueable;

    /** The number of times the job may be attempted.*/
    public int $tries = 5;

    /** The number of seconds to wait before retrying the job. */
    public int $backoff = 3;

    /** Create a new job instance. */
    public function __construct(public Wallet $wallet)
    {
    }

    /**
     * Schedule the notification to be sent by job.
     *
     * @param TransferRepository $transferRepository
     *
     * @throws \Throwable
     */
    public function handle(TransferRepository $transferRepository): void
    {
        $response = $transferRepository->notify()->object();

        throw_if(
            $response?->status === 'error',
            TransferException::notNotified(data: $this->wallet->toJson())
        );
    }
}
