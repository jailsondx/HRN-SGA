<?php
// DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
date_default_timezone_set('America/Fortaleza');

/**
 * Função para formatar um número com zeros à esquerda conforme as regras especificadas
 *
 * @param int $numero O número a ser formatado
 * @return string O número formatado com zeros à esquerda
 */
function formatarNumeroTicket($numero_nao_formatado) {
    $numero_formatado = (string)$numero_nao_formatado; // Garantir que o número seja tratado como string
    if (strlen($numero_formatado) == 1) {
        return str_pad($numero_formatado, 3, '0', STR_PAD_LEFT); // Adiciona 2 zeros à esquerda
    } elseif (strlen($numero_formatado) == 2) {
        return str_pad($numero_formatado, 3, '0', STR_PAD_LEFT); // Adiciona 1 zero à esquerda
    } else {
        return $numero_formatado; // Mantém o número como está
    }
}

?>
