<?php

namespace App\Proxy\DataCNES;

class DataCNESHeaders
{
    public function getProfessionalsHeader()
    {
        $professionalsHeader['Referer'] = 'https://cnes.datasus.gov.br/pages/profissionais/consulta.jsp';
        $professionalsHeader['Host'] = 'cnes.datasus.gov.br';

        return array_merge($this->getHeader(), $professionalsHeader);
    }

    public function getEstablishmentHeader()
    {
        $establishmentHeader['Referer'] = 'https://cnes.datasus.gov.br/pages/estabelecimentos/consulta.jsp';
        $establishmentHeader['Host'] = 'cnes.datasus.gov.br';

        return array_merge($this->getHeader(), $establishmentHeader);
    }

    public function getCBOHeader()
    {
        $cboHeader['Host'] = 'sistemas.unasus.gov.br';

        return array_merge($this->getHeader(), $cboHeader);
    }

    private function getHeader()
    {
        $header = array_change_key_case(getallheaders());

        $header['method'] = 'GET';
        $header['scheme'] = 'https';
        $header['accept'] = 'application/json, text/plain, */*';
        $header['sec-fetch-dest'] = 'empty';
        $header['sec-fetch-mode'] = 'cors';
        $header['sec-fetch-site'] = 'same-origin';
        $header['User-Agent'] = 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36';

        $header = array_diff_key($header, array_flip($this->getIgnoreHeaders()));

        return $header;
    }

    private function getIgnoreHeaders()
    {
        return [
            'cookie',
            'host',
            'connection',
            'upgrade-insecure-requests',
            'sec-fetch-user',
            'content-length',
            'content-type',
            'upgrade-insecure-requests',
            'cache-control'
        ];
    }
}