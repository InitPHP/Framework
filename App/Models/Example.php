<?php
declare(strict_types=1);

namespace App\Models;

class Example extends \InitPHP\Database\Model
{

    /**
     * Dönüş için kullanılacak Entity sınıfı ya da nesnesi.
     *
     * @var \InitPHP\Database\Interfaces\EntityInterface|string
     */
    protected $entity = \InitPHP\Database\Entity::class;

    /**
     * Modelin kullanacağı tablo adını tanımlar. Belirtilmez ya da boş bir değer belirtilirse model sınıfınızın adı kullanılır.
     *
     * @var string
     */
    protected string $table = 'users';

    /**
     * Tablonuzun PRIMARY KEY sütununun adını tanımlar. Eğer tablonuzda böyle bir sütun yoksa FALSE ya da NULL tanımlayın.
     *
     * @var null|string
     */
    protected ?string $primaryKey = 'id';

    /**
     * Yumuşak silmenin kullanılıp kullanılmayacağını tanımlar. Eğer FALSE ise veri kalıcı olarak silinir. TRUE ise $deletedField doğru tanımlanmış bir sütun adı olmalıdır.
     *
     * @var bool
     */
    protected bool $useSoftDeletes = true;

    /**
     * Verinin eklenme zamanını ISO 8601 formatında tutacak sütun adı.
     *
     * @var string|null
     */
    protected ?string $createdField = 'created_at';

    /**
     * Verinin son güncellenme zamanını ISO 8601 formatında tutacak sütun adı. Bu sütunun varsayılan değeri NULL olmalıdır.
     *
     * @var string|null
     */
    protected ?string $updatedField = 'updated_at';

    /**
     * Yumuşak silme aktifse verinin silinme zamanını ISO 8601 formatında tutacak sütun adı. Bu sütun varsayılan değeri NULL olmalıdır.
     *
     * @var string|null
     */
    protected ?string $deletedField = 'deleted_at';

    /**
     * Ekleme ve güncelleme gibi işlemlerde tanımlanmasına izin verilecek sütun isimlerini tutan dizi. NULL ise tüm sütunların değiştirilmesine izin verilir.
     *
     * @var string[]|null
     */
    protected ?array $allowedFields = [
        'id', 'mail', 'username'
    ];

    /**
     * Ekleme, Silme ve Güncelleme işlemlerinde geri çağrılabilir yöntemlerin kullanılıp kullanılmayacağını tanımlar.
     *
     * @var bool
     */
    protected bool $allowedCallbacks = false;

    /**
     * Insert işlemi öncesinde çalıştırılacak yöntemleri tanımlar. Bu yöntemlere eklenmek istenen veri bir ilişkisel dizi olarak gönderilir ve geriye eklenecek veri dizisini döndürmesi gerekir.
     *
     * @var string[]|\Closure[]
     */
    protected array $beforeInsert = [];

    /**
     * Insert işlemi yürütüldükten sonra çalıştırılacak yöntemleri tanımlar. Eklenen veriyi ilişkisel bir dizi olarak alır ve yine bu diziyi döndürmesi gerekir.
     *
     * @var string[]|\Closure[]
     */
    protected array $afterInsert = [];

    /**
     * Update işlemi yürütülmeden önce çalıştırılacak yöntemleri tanımlar. Güncellenecek sütun ve değerleri ilişkisel bir dizi olarak gönderilir ve yine bu dizi döndürmesi gerekir.
     *
     * @var string[]|\Closure[]
     */
    protected array $beforeUpdate = [];

    /**
     * Update işlemi yürütüldükten sonra çalıştırılacak yöntemleri tanımlar. Güncellenmiş sütun ve değerleri ilişkisel bir dizi olarak gönderilir ve yine bu dizi döndürmesi gerekir.
     *
     * @var string[]|\Closure[]
     */
    protected array $afterUpdate = [];

    /**
     * Delete işlemi yürülmeden önce çalıştırılacak yöntemleri tanımlar.Etkilenecek satırların çoklu ilişkisel dizisi parametre olarak gönderilir ve yine bu dizi döndürmesi gerekir.
     *
     * @var string[]|\Closure[]
     */
    protected array $beforeDelete = [];

    /**
     * Delete işlemi yürütüldükten sonra çalıştırılacak yöntemleri tanımlar. Etkilenmiş satırların çoklu ilişkisel dizisi parametre olarak gönderilir ve yine bu dizi döndürmesi gerekir.
     *
     * @var string[]|\Closure[]
     */
    protected array $afterDelete = [];

    /**
     * Bu modelin veriyi okuyabilir mi olduğunu tanımlar.
     *
     * @var bool
     */
    protected bool $readable = true;

    /**
     * Bu modelin bir veri yazabilir mi olduğunu tanımlar.
     *
     * @var bool
     */
    protected bool $writable = true;

    /**
     * Bu modelin bir veri silebilir mi olduğunu tanımlar.
     *
     * @var bool
     */
    protected bool $deletable = true;

    /**
     * Bu modelin bir veriyi güncelleyebilir mi olduğunu tanımlar.
     *
     * @var bool
     */
    protected bool $updatable = true;

    /**
     * Hangi sütunların hangi doğrulama yöntemine uyması gerektiğini tanımlayan dizi.
     *
     * Daha fazla doğrulama yöntemi için https://github.com/InitPHP/Validation bakınız.
     *
     * @var array
     */
    protected array $validation = [
        'id'    => ['integer', 'is_unique'],
        'mail'  => ['required', 'string', 'mail', 'length(10...255)', 'is_unique']
    ];

    /**
     * Sütun ve doğrulama yöntemlerine özel oluşacak hata mesajlarını özelleştirmenize/yerelleştirmeniz için kullanılan dizi.
     *
     * @var array
     */
    protected array $validationMsg = [
        'mail'  => [
            'is_unique' => '{field} başkası tarafından kullanılıyor',
            'required'  => '{field} boş bırakılamaz',
        ]
    ];

    /**
     * Sütun ve doğrulama yöntemlerine özel oluşturulacak hata mesajlarında {field} yerini alacak sütun adı yerine kullanılacak değerleri tanımlayan ilişkisel dizi.
     *
     * @var array
     */
    protected array $validationLabels = [
        'mail'  => 'Mail adresi'
    ];

}
