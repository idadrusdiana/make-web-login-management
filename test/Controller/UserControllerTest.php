<?php

namespace ProgrammerZamanNow\Belajar\PHP\MVC\App {
    
    function header(string $value){
        echo $value;
    }
}

namespace ProgrammerZamanNow\Belajar\PHP\MVC\Controller {
    
    use PHPUnit\Framework\TestCase;
    use ProgrammerZamanNow\Belajar\PHP\MVC\Config\Database;
    use ProgrammerZamanNow\Belajar\PHP\MVC\Domain\User;
    use ProgrammerZamanNow\Belajar\PHP\MVC\Repository\UserRepository;
    
    class UserControllerTest extends TestCase
    {
        private UserController $userController;
        private UserRepository $userRepository;

        protected function setUp(): void
        {
            $this->userController = new UserController();
    
            $this->userRepository = new UserRepository(Database::getConnection());
            $this->userRepository->deleteAll();

            putenv("mode=test");
        }
    
        public function testRegister()
        {
            $this->userController->register();
    
            $this->expectOutputRegex("[Register]");
            $this->expectOutputRegex("[Id]");
            $this->expectOutputRegex("[Name]");
            $this->expectOutputRegex("[Password]");
            $this->expectOutputRegex("[Register new User]");
        }
    
        public function testPostRegisterSuccess()
        {
            $_POST['id'] = 'Idad';
            $_POST['name'] = 'Idad';
            $_POST['password'] = 'rahasia';
    
            $this->userController->postRegister();

            $this->expectOutputRegex("[Location: /users/login]");
        }
    
        public function testPostRegisterValidationError()
        {
            $_POST['id'] = '';
            $_POST['name'] = 'Idad';
            $_POST['password'] = 'rahasia';
    
            $this->userController->postRegister();
    
            $this->expectOutputRegex("[Register]");
            $this->expectOutputRegex("[Id]");
            $this->expectOutputRegex("[Name]");
            $this->expectOutputRegex("[Password]");
            $this->expectOutputRegex("[Register new User]");
            $this->expectOutputRegex("[Id, Name, Password can not blank]");
        }  
    
        public function testPostRegisterDuplicate()
        {
            $_POST['id'] = '';
            $_POST['name'] = 'Idad';
            $_POST['password'] = 'rahasia';
    
            $this->userController->postRegister();
    
            $this->expectOutputRegex("[Register]");
            $this->expectOutputRegex("[Id]");
            $this->expectOutputRegex("[Name]");
            $this->expectOutputRegex("[Password]");
            $this->expectOutputRegex("[Register new User]");
            $this->expectOutputRegex("[Id, Name, Password can not blank]");
        }
    }
}
