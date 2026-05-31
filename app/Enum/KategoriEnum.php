<?

namespace App\Enum;


enum KategoriEnum: string
{
    case DAKWAH = "Dakwah";
    case PENDIDIKAN = "Pendidikan";
    case SOSIAL = 'Sosial';
    case ORGANISASI = 'Organisasi';

    public function label(): string
    {
        return match($this) {
            self::DAKWAH => "Dakwah",
            self::PENDIDIKAN => "Pendidikan",
            self::SOSIAL => "Sosial",
            self::ORGANISASI => "Organisasi",
        };
    }

    public static function options(): array
    {
        return [
            self::DAKWAH->value => self::DAKWAH->label(),
            self::PENDIDIKAN->value => self::PENDIDIKAN->label(),
            self::SOSIAL->value => self::SOSIAL->label(),
            self::ORGANISASI->value => self::ORGANISASI->label(),
        ];
    }
}
