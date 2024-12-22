# Cake LESS
LESS helper for CakePHP

## Requirements

* CakePHP 5.x
* Less.php

## What's included?

- LessHelper

## Table of contents

- [Installation](#installation)
- [Usage](#usage)
- [Contributing](#contributing)
- [License](#license)

## Installation

`cd` to the root of your app folder (where the `composer.json` file is) and run the following [Composer][composer]
command:

```
composer require brammo/cake-less
```

Then load the plugin using CakePHP's console:

```
bin/cake plugin load Less
```

## Usage

In the HTML head tag add:

```
<?= $this->Less->link('/path/to/styles.less') ?>
```

## Contributing

### Patches & Features

### Bugs & Feedback

https://github.com/bramml/cake-less/issues

## License

Copyright (c) 2024, Roman Sidorkin and licensed under [The MIT License][mit].

[cakephp]:https://cakephp.org/
[less.php]:https://github.com/wikimedia/less.php
[composer]:https://getcomposer.org/
[composer:ignore]:https://getcomposer.org/doc/faqs/should-i-commit-the-dependencies-in-my-vendor-directory.md
[mit]:https://opensource.org/licenses/mit-license.php
