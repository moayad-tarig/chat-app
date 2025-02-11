# ChatLaravel - Modern Real-Time Chat Application

A modern, real-time chat application built with the TALL stack (Tailwind CSS, Alpine.js, Laravel, and Livewire) and enhanced with Laravel Reverb for WebSocket functionality.

## 🚀 Tech Stack

### Core Stack (TALL)
- **[Tailwind CSS](https://tailwindcss.com)** - Utility-first CSS framework
- **[Alpine.js](https://alpinejs.dev)** - Lightweight JavaScript framework
- **[Laravel](https://laravel.com)** - PHP web application framework
- **[Livewire](https://livewire.laravel.com)** - Full-stack framework for Laravel

### Real-Time Communication
- **[Laravel Reverb](https://laravel.com/docs/10.x/reverb)** - WebSocket server for real-time features
  - Handles real-time message delivery
  - Manages presence channels for online status
  - Scales horizontally for high-traffic scenarios

### Development Tools
- **[PHPStan](https://phpstan.org/)** - Static analysis tool
  ```bash
  composer require --dev phpstan/phpstan
  ./vendor/bin/phpstan analyse
  ```

- **[Rector](https://getrector.org/)** - Automated code upgrades and refactoring
  ```bash
  composer require --dev rector/rector
  ./vendor/bin/rector process
  ```

- **[Laravel Pint](https://laravel.com/docs/10.x/pint)** - Opinionated PHP code style fixer
  ```bash
  composer require laravel/pint --dev
  ./vendor/bin/pint
  ```

- **[Pest](https://pestphp.com/)** - Testing Framework
  ```bash
  composer require pestphp/pest --dev
  ./vendor/bin/pest
  ```

## 🛠 Installation

1. Clone the repository
   ```bash
   git clone https://github.com/your-username/chat-laravel.git
   ```

2. Install dependencies
   ```bash
   composer install
   npm install
   ```

3. Configure environment
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Set up the database
   ```bash
   php artisan migrate
   ```

5. Start Reverb WebSocket server
   ```bash
   php artisan reverb:start
   ```

6. Run the application
   ```bash
   php artisan serve
   npm run dev
   ```

## 🧪 Testing

We use Pest PHP for testing. Our test suite includes:

- Feature Tests
- Unit Tests
- Integration Tests
- WebSocket Tests

Run tests with:
```bash
./vendor/bin/pest
```

## 📊 Code Quality

### Static Analysis with PHPStan
We maintain a high level of code quality using PHPStan at max level:

```bash
./vendor/bin/phpstan analyse --level max
```

### Automated Refactoring with Rector
Keep the codebase modern and clean:

```bash
./vendor/bin/rector process
```

### Code Style with Laravel Pint
Maintain consistent code style:

```bash
./vendor/bin/pint
```

## 🔒 Security

- All WebSocket connections are authenticated
- CSRF protection enabled
- XSS prevention measures
- Rate limiting on all endpoints
- Input validation using Laravel's form request validation

## 🌟 Features

- Real-time messaging
- Group chat support
- Online presence indicators
- Message read receipts
- File sharing
- Emoji support
- Message search
- User profiles
- Mobile responsive design

## 🤝 Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Run tests and static analysis
   ```bash
   ./vendor/bin/pest
   ./vendor/bin/phpstan analyse
   ./vendor/bin/pint
   ```
4. Commit your changes (`git commit -m 'Add some amazing feature'`)
5. Push to the branch (`git push origin feature/amazing-feature`)
6. Open a Pull Request

## 📝 Code Style

We follow Laravel's coding style guidelines. All PHP code is automatically formatted using Laravel Pint:

```bash
./vendor/bin/pint
```

## 📄 License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details.

## 🙏 Acknowledgments

- Laravel Team for the amazing framework
- Tailwind CSS Team
- Alpine.js Team
- Livewire Team
- All our contributors

## 📞 Support

For support, email support@chatlaravel.com or join our Discord channel.