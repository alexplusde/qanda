# SSS / REDAXO 5.x için Sorular ve Cevaplar & YForm 4.x

Bu eklenti ile SSS alanları ve genel soruların yanı sıra & cevap girilebilir ve yönetilebilir. Ticari olmayan projeler için ücretsiz (CC BY-NC-SA 4.0). Lisans ve kullanımla ilgili herhangi bir sorunuz varsa, lütfen qanda@alexplus.de ile iletişime geçin.

![GitHub logosu](https://raw.githubusercontent.com/alexplusde/qanda/main/docs/screenshot.png)


## özellikleri

* **YForm** ile tamamen uygulandı: YForm'un tüm özellikleri ve özelleştirme seçenekleri mevcut
* Basit: Çıktı [`rex_sql`](https://redaxo.org/doku/master/datenbank-queries) üzerinden veya [YOrm](https://github.com/yakamara/redaxo_yform_docs/blob/master/de_de/yorm.md)üzerinden nesne yönelimli
* Esnek: Soruları ve yanıtları kategoriye göre filtreleyin
* Faydalı: Yalnızca seçilen **rol**/düzenleyiciler erişebilir
* Arama motoru optimize edildi: [JSON+LD formatı](https://jsonld.com/question-and-answer/) için hazır ve schema.org'a dayalı yapılandırılmış veriler
* Çok daha fazlası için hazır: [URL2 addon](https://github.com/tbaddade/redaxo_url)ile uyumlu

> **İpucu:** Eklenti, eklentilerle birlikte harika çalışıyor [`yform_usability`](https://github.com/FriendsOfREDAXO/yform_usability/)

> **Kendi geliştirmelerinizi** [qanda](https://github.com/alexplusde/qanda) GitHub deposuna katkıda bulunun. Veya **bu eklentiyi destekler:** [siparişiyle bu eklentinin daha da geliştirilmesini desteklersiniz](https://github.com/sponsors/alexplusde)

## Kurulum

`qanda` eklentisini REDAXO yükleyicisine indirin ve kurun. Ardından yeni bir menü öğesi `Soru & Cevap`belirir.

## Ön uçta kullanın

### örnek modül

```php
<h1>SSS sayfası</h1>
<?php

echo qanda::showFAQPage(qanda::getAll()); // Json+ld

foreach (qanda::getAll() as $question) {
    echo '<details><summary>'.$question->getQuestion().'</summary>';
    yankı '<div class="answer">'.$question->getAnswer().'</div></details>';
}
?>
```

```php
<h3>En önemli sorular</h3>
<?php
foreach (qanda::getAll() as $question) {
    echo '<details><summary>'.$question->getQuestion().'</summary>';
    yankı '<div class="answer">'.$question->getAnswer().'</div></details>';
    yankı qanda::showJsonLd($question);
}
?>
```

### Sınıf `qanda`

`rex_yform_manager_dataset`yazın. Sorular ve yanıtlarla birlikte `rex_qanda` tablosuna erişir.

#### örnek çıktı

```php
$question = kanda::get(3); // id'li soru=3

// soru cevap
dump($question->getQuestion()); // Soru
dökümü($question->getAuthor()); //
sorunun yazarı dump($question->getAnswer()); // HTML olarak cevapla (eğer bir editör belirtilmişse)
dump($question->getAnswerAsPlaintext()); // HTML

yerine metin olarak yanıt ver // Kategori
dump($question->getCategory()); // id=3 olan soru/cevap kategorisi
dump($question->getCategories()); // id=3 olan soru/cevap kategorileri

// Diğer yöntemler
dump($question->getUrl()); // "soru-{id}" etiketli geçerli sayfanın URL'si
```

https://github.com/yakamara/redaxo_yform/blob/master/docs/04_yorm.md adresinde daha fazla yöntem

### `sınıfı qanda_category`

`rex_yform_manager_dataset`yazın. Tablo `rex_qanda_category` erişir.

#### Bir kategorinin örnek çıktısı

```php
dump(qanda_category::get(3)); // id=3 olan kategori
dump(qanda_category::get(3)->getAllQuestions()); // Kategori id=3'ün tüm soru-cevap çiftleri
```

https://github.com/yakamara/redaxo_yform/blob/master/docs/04_yorm.md adresinde daha fazla yöntem

## Arka uçta kullanın: soru ve cevap girişi.

### SORULAR tablosu

Bireysel soru-cevap kombinasyonları tablo `rex_qanda` kaydedilir. `qanda` yükledikten sonra aşağıdaki alanlar kullanılabilir:

| Tip        | tür adı               | Soyadı                 | atama              |
| ---------- | --------------------- | ---------------------- | ------------------ |
| değer      | Metin                 | soru                   | soru               |
| doğrulamak | boş                   | soru                   |                    |
| değer      | metin alanı           | Cevap                  | Cevap              |
| değer      | be_manager_relation | qanda_category_id    | kategori           |
| değer      | tarih damgası         | oluşturulan tarih      | oluşturulma tarihi |
| değer      | be_user               | güncelleme kullanıcısı | Son değişiklik:    |
| değer      | be_user               | Kullanıcı oluştur      | yazar              |
| değer      | öncelik               | öncelik                | Diziler            |

En önemli doğrulamalar zaten eklenmiştir.

### KATEGORİLER tablosu

Kategoriler tablosu, soruları/cevapları veya anahtar kelimeleri (etiket olarak) gruplamak için serbestçe değiştirilebilir.

| Tip        | tür adı   | Soyadı | atama  |
| ---------- | --------- | ------ | ------ |
| değer      | Metin     | Soyadı | Başlık |
| doğrulamak | benzersiz | Soyadı |        |
| doğrulamak | boş       | Soyadı |        |
| değer      | seçim     | durum  | durum  |

## lisans

MIT lisansı

## yazar

**Alexander Walther**  
http://www.alexplus.de  
https://github.com/alexplusde

**Proje lideri**  
[Alexander Walther](https://github.com/alexplusde)

## kredi

qanda şuna dayanmaktadır: [YForm](https://github.com/yakamara/redaxo_yform)  
