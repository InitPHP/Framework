# InitPHP Framework

InitPHP Framework, is the most minimalist web framework manager using MVC architecture.

[![Latest Stable Version](http://poser.pugx.org/initphp/framework/v)](https://packagist.org/packages/initphp/framework) [![Total Downloads](http://poser.pugx.org/initphp/framework/downloads)](https://packagist.org/packages/initphp/framework) [![Latest Unstable Version](http://poser.pugx.org/initphp/framework/v/unstable)](https://packagist.org/packages/initphp/framework) [![License](http://poser.pugx.org/initphp/framework/license)](https://packagist.org/packages/initphp/framework) [![PHP Version Require](http://poser.pugx.org/initphp/framework/require/php)](https://packagist.org/packages/initphp/framework)

This framework offers only the most essential infrastructure tools and structure. Although it is minimalist, the most basic libraries it offers have the ability to compete with large frameworks. 

### What does it offer?

It offers basic libraries that every project needs, such as Configurations, HTTP Routing, Database Abstraction and ORM, Multi-Language Support, Triggerable Events, User Inputs, Logger, Validation.

If you need more; You can simply integrate any Init PHP library or a different library into your project.

## Installation

```
composer create-project initphp/framework MyProject
```

## Usage

It has a file and directory structure similar to the MVC frameworks that developers are used to. The classes and libraries of your application are in the `/App/` directory.

**_Note :_** If your project runs in a subdirectory, specify it in the `BASE_PATH` configuration in the `/.env` file.

You can find Route and other definitions in files and classes in the `/App/Configs/` directory. 

For Route operations, we use the `\InitPHP\Framework\Route` class, which abstracts the [InitPHP Router](https://github.com/InitPHP/Router) library. So you can use library methods as static or non-static.

## To-Do

-[ ] Detailed documentation or Wiki will be prepared.

## Getting Help

If you have questions, concerns, bug reports, etc, please file an issue in this repository's Issue Tracker.

## Contributing

> All contributions to this project will be published under the MIT License. By submitting a pull request or filing a bug, issue, or feature request, you are agreeing to comply with this waiver of copyright interest.

- Fork it ( https://github.com/InitPHP/Framework/fork )
- Create your feature branch (git checkout -b my-new-feature)
- Commit your changes (git commit -am "Add some feature")
- Push to the branch (git push origin my-new-feature)
- Create a new Pull Request

## Credits

- [Muhammet ŞAFAK](https://www.muhammetsafak.com.tr) <<info@muhammetsafak.com.tr>>

## License

Copyright © 2022 [MIT License](./LICENSE)