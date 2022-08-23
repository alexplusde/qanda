# FAQ / Preguntas y Respuestas para REDAXO 5.x & YForm 4.x

Con este complemento, se pueden ingresar y administrar áreas de preguntas frecuentes y preguntas & sin respuestas. Gratis para proyectos no comerciales (CC BY-NC-SA 4.0). Si tiene alguna pregunta sobre la licencia y el uso, comuníquese con qanda@alexplus.de.

![Logotipo de GitHub](https://raw.githubusercontent.com/alexplusde/qanda/main/docs/screenshot.png)


## caracteristicas

* Totalmente implementado con **YForm** : todas las funciones y opciones de personalización de YForm disponibles
* Simple: la salida es a través de [`rex_sql`](https://redaxo.org/doku/master/datenbank-queries) u orientada a objetos a través [YOrm](https://github.com/yakamara/redaxo_yform_docs/blob/master/de_de/yorm.md)
* Flexible: filtre preguntas y respuestas por categorías
* Útil: Solo los **roles seleccionados**/editores tienen acceso
* Optimizado para motores de búsqueda: Listo para [formato JSON+LD](https://jsonld.com/question-and-answer/) y datos estructurados basados en schema.org
* Listo para mucho más: Compatible con [URL2 addon](https://github.com/tbaddade/redaxo_url)

> **Consejo:** El complemento funciona muy bien junto con los complementos [`yform_usability`](https://github.com/FriendsOfREDAXO/yform_usability/)

> **Contribuya con sus propias mejoras** al repositorio de [qanda](https://github.com/alexplusde/qanda) GitHub. O **admite este complemento:** Con un pedido [, apoya el desarrollo adicional de este complemento](https://github.com/sponsors/alexplusde)

## instalación

Descarga e instala el addon `qanda` en el instalador de REDAXO. A continuación, aparece un nuevo elemento de menú `Preguntas & Respuestas`.

## Usar en la interfaz

### módulo de ejemplo

```php
<h1>Página de preguntas frecuentes</h1>
<?php

echo qanda::showFAQPage(qanda::getAll()); // Json+ld

foreach (qanda::getAll() as $question) {
    echo '<details><summary>'.$question->obtenerPregunta().'</summary>';
    eco '<div class="answer">'.$question->obtenerRespuesta().'</div></details>';
}
?>
```

```php
<h3>Las preguntas más importantes</h3>
<?php
foreach (qanda::getAll() as $question) {
    echo '<details><summary>'.$question->obtenerPregunta().'</summary>';
    eco '<div class="answer">'.$question->obtenerRespuesta().'</div></details>';
    echo qanda::showJsonLd($question);
}
?>
```

### La clase `qanda`

Escriba `rex_yform_manager_dataset`. Accede a la tabla `rex_qanda` con preguntas y respuestas.

#### salida de muestra

```php
$question = qanda::obtener(3); // pregunta con id=3

// pregunta y respuesta
dump($question->getQuestion()); // Pregunta
dump($question->getAuthor()); // autor de la pregunta
dump($question->getAnswer()); // Responder como HTML (si se especificó un editor)
dump($question->getAnswerAsPlaintext()); // Respuesta como texto en lugar de HTML

// Categoría
dump($question->getCategory()); // Categoría para pregunta/respuesta con id=3
dump($question->getCategories()); // Categorías para la pregunta/respuesta con id=3

// Otros métodos
dump($question->getUrl()); // URL a la página actual con la etiqueta `question-header-{id}
```

Más métodos en https://github.com/yakamara/redaxo_yform/blob/master/docs/04_yorm.md

### La clase `qanda_category`

Escriba `rex_yform_manager_dataset`. Accede a la tabla `rex_qanda_category`.

#### Salida de muestra de una categoría

```php
dump(qanda_category::get(3)); // categoría con id=3
dump(qanda_category::get(3)->getAllQuestions()); // Todos los pares de preguntas y respuestas de la categoría id=3
```

Más métodos en https://github.com/yakamara/redaxo_yform/blob/master/docs/04_yorm.md

## Uso en el backend: ingreso de preguntas y respuestas.

### La mesa de PREGUNTAS

Las combinaciones de preguntas y respuestas individuales se registran en la tabla `rex_qanda`. Después de instalar `qanda` , los siguientes campos están disponibles:

| Escribe | escribe un nombre     | Apellido            | designacion       |
| ------- | --------------------- | ------------------- | ----------------- |
| valor   | texto                 | pregunta            | pregunta          |
| validar | vacío                 | pregunta            |                   |
| valor   | área de texto         | responder           | responder         |
| valor   | be_manager_relation | qanda_category_id | categoría         |
| valor   | sello de la fecha     | Fecha de creación   | fecha de creación |
| valor   | ser_usuario           | actualizar usuario  | último cambio por |
| valor   | ser_usuario           | crear usuario       | autor             |
| valor   | prioridad             | prioridad           | Serie             |

Las validaciones más importantes ya han sido insertadas.

### La tabla de CATEGORÍAS

La tabla de categorías se puede modificar libremente para agrupar preguntas/respuestas o palabras clave (como etiquetas).

| Escribe | escribe un nombre | Apellido | designacion |
| ------- | ----------------- | -------- | ----------- |
| valor   | texto             | Apellido | título      |
| validar | único             | Apellido |             |
| validar | vacío             | Apellido |             |
| valor   | elección          | estado   | estado      |

## licencia

licencia MIT

## autor

**Alexander Walther**  
http://www.alexplus.de  
https://github.com/alexplusde

**Líder de proyecto**  
[Alexander Walther](https://github.com/alexplusde)

## creditos

qanda se basa en: [YForm](https://github.com/yakamara/redaxo_yform)  
