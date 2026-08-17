<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Equipment;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Writer\SvgWriter;
use RuntimeException;

final class QrCodeService
{
    /**
     * URL pública que o QR Code deverá codificar.
     */
    public function urlFor(Equipment $equipment): string
    {
        return route('ticket.public.create', ['machine_id' => $equipment->id]);
    }

    /**
     * Gera o QR Code em formato PNG (binário) para download.
     */
    public function png(Equipment $equipment): string
    {
        $result = (new PngWriter())->write(new QrCode($this->urlFor($equipment)));

        return $result->getString();
    }

    /**
     * Gera o QR Code como Data URI (PNG) para incorporar em <img> ou PDF.
     */
    public function pngDataUri(Equipment $equipment): string
    {
        $result = (new PngWriter())->write(new QrCode($this->urlFor($equipment)));

        $dataUri = $result->getDataUri();

        if (! is_string($dataUri) || $dataUri === '') {
            throw new RuntimeException('Não foi possível gerar o QR Code em formato PNG.');
        }

        return $dataUri;
    }

    /**
     * Gera o QR Code em formato SVG (vetorial) para impressão de alta qualidade.
     */
    public function svg(Equipment $equipment): string
    {
        $result = (new SvgWriter())->write(new QrCode($this->urlFor($equipment)));

        return $result->getString();
    }
}
