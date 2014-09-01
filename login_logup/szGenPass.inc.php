<?php
/* szGenPass.inc.php - Classe Generatore Password
 *
 * Copyright (C) 2004 Giuseppe Caulo <giusc@softzone.it>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */

/*
 *  Esempio d'uso:
 *
 *  include_once('szGenPass.inc.php');
 *
 *  // Uso semplice, genera una password di 8 caratteri e la scrive a video
 *  print szGenPass::generatePassword();
 *  // Passo come parametro la lunghezza desiderata della password da generare
 *  print szGenPass::generatePassword(6);
 *
 *  // Verifica che la validita' di una password
 *  if (szGenPass::validPass($my_pass))
 *    print "Password valida";
 *  else
 *    print "Password non valida";
 *
 */

class szGenPass {

    function szGenPass() {
      szGenPass::entropize();
    }

    function make_seed()
    {
        list($usec, $sec) = explode(' ', microtime());
        return (float) ((float) $usec * 10000000);
    }

    function entropize() {
      srand(szGenPass::makeSeed());
    }

    function randValue($length = 1, $values = "")
    {
        $rc = "";
        if (empty($values))
            $values = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ";

        for ($i = 0;$i < intval($length);$i++) {
            $rc .= $values[rand(0, strlen($values)-1)];
        }
        return $rc;
    }

    function generatePassword($length = 8)
    {
        $fill = "1234567890$!@#%*-";

        if ($length < 3) die("generatePassword error: length must be greater than 2");

        // Lettere e Dittonghi
        $v = array('a', 'e', 'i', 'o', 'u', 'ae', 'ou', 'io', 'ea', 'ou', 'ia', 'ai');
        $c = array('b', 'c', 'd', 'g', 'h', 'j', 'k', 'l', 'm',
                   'n', 'p', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y',
                   'tr', 'cr', 'fr', 'dr', 'wr', 'pr', 'th',
                   'ch', 'ph', 'st', 'sl', 'cl', 'mp');
        $v_count = count($v);
        $c_count = count($c);
        $fill_max = ceil($length / 4);

		$fc = 0;
		$uc = 0;
		$rc = "";
		$rc_bak = "";
		for ($i = 0; $i < $length; $i++) {
			// Aggiunge numero o simbolo di riempimento
			if (($fc < $fill_max) && (mt_rand(0, 1) == 1)) {
				$fc++;
				$rc .= szGenPass::randValue(1, $fill);
			}

			if (mt_rand(0, 1) == 1) {
				$chr1 = $c[mt_rand(0, $c_count-1)];
				$chr2 = $v[mt_rand(0, $v_count-1)];
			} else {
				$chr1 = $v[mt_rand(0, $v_count-1)];
				$chr2 = $c[mt_rand(0, $c_count-1)];
			}
			// Converte alcuni caratteri in maiuscolo
			if (($uc < $fill_max) && (mt_rand(0, 1) == 1)) {
				$uc++;
				$chr1 = strtoupper($chr1);
			}
			$chr = $chr1 . $chr2;

			$rc .= $chr;
		}
		$rc = substr($rc, 0, $length);

		if (!szGenPass::validPass($rc)) {
			return szGenPass::generatePassword($length);
		} else {
		    return $rc;
		}
    }

    function validPass($str) {
        // La password deve contenere almeno un simbolo oppure
        // un numero, una lettera minuscola ed una lettera maiuscola
        if (preg_match('/[$!@#%\*-]/', $str) ||
            preg_match('/^\w*(?=\w*\d)(?=\w*[a-z])(?=\w*[A-Z])\w*$/', $str))
          return true;
        else
          return false;
    }
}

?>