# Quiz Website App

## Description

This is a Laravel-based quiz website designed to provide users with an interactive platform for taking quizzes on various topics. With a sleek and user-friendly interface, users can easily navigate through different quizzes, test their knowledge, and view their results. Whether you're a student looking to review your learning or a trivia enthusiast seeking entertainment, our quiz website has something for everyone.

## Getting Started

### Prerequisites

Before you begin, make sure you have Docker installed on your system. You can download and install Docker from the [official website](https://www.docker.com/).

### Installation

1. Clone the repository to your local machine:

    ```bash
    git clone <repository_url>
    ```

2. Navigate to the project directory:

    ```bash
    cd quiz-app
    ```

3. Install PHP dependencies using Composer:

    ```bash
    composer install
    ```

4. Copy the environment configuration file:

    ```bash
    cp .env.production .env
    ```

5. Build and start the Docker containers:

    ```bash
    docker-compose build
    docker-compose up -d
    ```

### Usage

Once the Docker containers are up and running, you can access the website by opening your web browser and navigating to [http://localhost:8000](http://localhost:8000). From there, you can register an account, log in, and start taking quizzes on various topics.

## Contributing

We welcome contributions from the community! If you encounter any bugs or have ideas for new features, please open an issue on our GitHub repository. If you'd like to contribute code, feel free to fork the repository and submit a pull request with your changes.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.
