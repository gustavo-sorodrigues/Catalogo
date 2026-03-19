<?php
class Midia
{
    private int $id;
    private string $titulo;
    private string $tipo;
    private string $sinopse;
    private string $trailer;
    private string $imagem;
    private int $ano;
    private int $destaque;
    private array $generos;

    public function __construct(array $dados = [])
    {
        $this->id = $dados['id'] ?? 0;
        $this->titulo = $dados['titulo'] ?? '';
        $this->tipo = $dados['tipo'] ?? '';
        $this->sinopse = $dados['sinopse'] ?? '';
        $this->trailer = $dados['trailer'] ?? '';
        $this->imagem = $dados['imagem'] ?? '';
        $this->ano = $dados['ano'] ?? 0;
        $this->destaque = $dados['destaque'] ?? 0;
        $this->generos = $dados['generos'] ?? [];
    }

    public function setTitulo(string $titulo)
    {
        if (empty($titulo)) {
            throw new Exception("Título não pode estar vazio");
        }
        $this->titulo = $titulo;
    }

    public function getTitulo(): string
    {
        return $this->titulo;
    }

    public function setTipo(string $tipo)
    {

        $this->tipo = $tipo;
    }

    public function getTipo(): string
    {
        return $this->tipo;
    }


    public function setAno(int $ano)
    {
        if ($ano < 1800 || $ano > 2100) {
            throw new Exception("Ano inválido");
        }
        $this->ano = $ano;
    }

    public function getAno(): int
    {
        return $this->ano;
    }

    public function setDestaque(int $destaque)
    {
        $this->destaque = $destaque ? 1 : 0;
    }

    public function getDestaque(): int
    {
        return $this->destaque;
    }

    public function setGeneros(array $generos)
    {
        $this->generos = $generos;
    }

    public function getGeneros(): array
    {
        return $this->generos;
    }

    public function setSinopse(string $sinopse)
    {
        $this->sinopse = $sinopse;
    }

    public function getSinopse(): string
    {
        return $this->sinopse;
    }

    public function settrailer(string $url)
    {
        $this->trailer = $url;
    }

    public function gettrailer(): string
    {
        return $this->trailer;
    }

    public function setImagem(string $imagem)
    {
        $this->imagem = $imagem;
    }

    public function getImagem(): string
    {
        return $this->imagem;
    }


    public function salvar(mysqli $conn)
    {
        if ($this->id > 0) {
            $sql = "UPDATE midias SET 
                        titulo='" . mysqli_real_escape_string($conn, $this->titulo) . "',
                        tipo='" . mysqli_real_escape_string($conn, $this->tipo) . "',
                        sinopse='" . mysqli_real_escape_string($conn, $this->sinopse) . "',
                        trailer='" . mysqli_real_escape_string($conn, $this->trailer) . "',
                        imagem='" . mysqli_real_escape_string($conn, $this->imagem) . "',
                        ano=" . $this->ano . ",
                        destaque=" . $this->destaque . "
                        WHERE id=" . $this->id;
            mysqli_query($conn, $sql);
        } else {
            $sql = "INSERT INTO midias (titulo, tipo, sinopse, trailer, imagem, ano, destaque)
                    VALUES (
                        '" . mysqli_real_escape_string($conn, $this->titulo) . "',
                        '" . mysqli_real_escape_string($conn, $this->tipo) . "',
                        '" . mysqli_real_escape_string($conn, $this->sinopse) . "',
                        '" . mysqli_real_escape_string($conn, $this->trailer) . "',
                        '" . mysqli_real_escape_string($conn, $this->imagem) . "',
                        " . $this->ano . ",
                        " . $this->destaque . "
                    )";
            mysqli_query($conn, $sql);
            $this->id = mysqli_insert_id($conn);
        }

        mysqli_query($conn, "DELETE FROM midias_generos WHERE midia_id=" . $this->id);
        foreach ($this->generos as $gen_id) {
            mysqli_query($conn, "INSERT INTO midias_generos (midia_id, genero_id) VALUES (" . $this->id . ", " . (int)$gen_id . ")");
        }
    }
}
