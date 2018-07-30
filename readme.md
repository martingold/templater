# Templater

[![Build Status](https://travis-ci.org/martingold/templater.svg?branch=master)](https://travis-ci.org/martingold/templater)

## Features

### TemplateMailer
Service for sending mails from latte templates. 

You can use CSS in header of templates or CSS file
defined in configuration, because using inline CSS
for each element is nasty.

```php
 $message = (new \Nette\Mail\Message())
    ->setSubject('Hello!')
    ->setTo('test@test.tld');
    
 $this->templateMailer->send('messageTemplate', $message, [
    'name' => 'John Doe',
    'items' => ...
 ]);
```

### PDF Handler
Service for generating PDF from latte templates

```
 $pdfParams = PdfParams::from()
            ->setTemplateName('pdf/contract')
            ->setFilename('project')
            ->setIdentifier(96325)
            ->setNamespace('contract');
 $this->pdfHandler->savePDF($pdfParams, $smlouva);
```
 - `$templateName` is filename/path of the template without `.latte` extension
 - `$filename` and `$identifier` makes name of the pdf. In this example
 name would be `project-96325.pdf`. The identifier is required when saving
 the pdf to avoid overwriting older files.
 - `$namespace` is a name/path of the folder which result will be saved to
 
 With this settings the resulting output path would be
 
 ```
 www/downloads/pdf/contract/project-96325.pdf
 ```
 
## Configuration

Register the extension: 
```yaml
extensions:
    templater: MartinGold\Templater\DI\TemplaterExtension
```

Configure extension. These are default values:
```yaml
templater:
    templatePath: 'app/templates/'
    cssTemplatePath: null
    pdfOutputPath: 'www/downloads/pdf/'
```

## Installation

```shell
composer require martingold/templater
```

