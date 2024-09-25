<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vigenere Cipher</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4><b>VIGENERE CIPHER</b></h4>
            </div>
            <div class="card-body">
                <?php
                // Fungsi untuk enkripsi karakter
                function vigenere_cipher($char, $key_char, $encrypt = true)
                {
                    $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $char = strtoupper($char);
                    $key_char = strtoupper($key_char);
                    
                    if (ctype_alpha($char)) {
                        $char_pos = strpos($alphabet, $char);
                        $key_pos = strpos($alphabet, $key_char);
                        
                        if ($encrypt) {
                            // Enkripsi
                            $new_pos = ($char_pos + $key_pos) % 26;
                        } else {
                            // Dekripsi
                            $new_pos = ($char_pos - $key_pos + 26) % 26;
                        }

                        return $alphabet[$new_pos];
                    } else {
                        return $char; // Mengembalikan karakter non-alphabet apa adanya
                    }
                }

                // Fungsi untuk enkripsi teks
                function vigenere_encrypt($input, $key)
                {
                    $output = "";
                    $key_len = strlen($key);
                    $input = strtoupper($input);
                    $key = strtoupper($key);
                    
                    $key_index = 0;
                    
                    foreach (str_split($input) as $char) {
                        if (ctype_alpha($char)) {
                            $output .= vigenere_cipher($char, $key[$key_index % $key_len]);
                            $key_index++;
                        } else {
                            $output .= $char;
                        }
                    }
                    return $output;
                }

                // Fungsi untuk dekripsi teks
                function vigenere_decrypt($input, $key)
                {
                    $output = "";
                    $key_len = strlen($key);
                    $input = strtoupper($input);
                    $key = strtoupper($key);
                    
                    $key_index = 0;

                    foreach (str_split($input) as $char) {
                        if (ctype_alpha($char)) {
                            $output .= vigenere_cipher($char, $key[$key_index % $key_len], false);
                            $key_index++;
                        } else {
                            $output .= $char;
                        }
                    }
                    return $output;
                }

                // Cek apakah tombol enkripsi atau dekripsi ditekan
                if (isset($_POST['enkripsi'])) {
                    $hasil = vigenere_encrypt($_POST['plain'], $_POST['key']);
                } else if (isset($_POST['dekripsi'])) {
                    $hasil = vigenere_decrypt($_POST['plain'], $_POST['key']);
                }
                ?>

                <!-- Form input -->
                <form name="vigenere" method="post">
                    <div class="input-group">
                        <input type="text" name="plain" class="form-control" placeholder="Input Text">
                    </div>
                    <div class="input-group">
                        <input type="text" name="key" class="form-control" placeholder="Input Key (Word)">
                    </div>
                    <div class="box-footer">
                        <input class="btn btn-success" type="submit" name="enkripsi" value="Enkripsi">
                        <input class="btn btn-danger" type="submit" name="dekripsi" value="Dekripsi">
                    </div>
                </form>
            </div>
            <!-- Bagian hasil enkripsi/dekripsi -->
            <div class="card-header output">
                <h4><b>HASIL</b></h4>
            </div>
            <div class="card-body result">
                <table>
                    <tr>
                        <td>Output yang dihasilkan:</td>
                        <td><b><?php if (isset($hasil)) { echo $hasil; } ?></b></td>
                    </tr>
                    <tr>
                        <td>Text yang dimasukkan:</td>
                        <td><b><?php if (isset($_POST['plain'])) { echo strtoupper($_POST['plain']); } ?></b></td>
                    </tr>
                    <tr>
                        <td>Key:</td>
                        <td><b><?php if (isset($_POST['key'])) { echo strtoupper($_POST['key']); } ?></b></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
