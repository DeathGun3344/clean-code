<?php

namespace DeathGun\CleanCode;


class MakeUseCase
{

    private string $useCaseName;
    private string $basePath;
    private string $baseNamespace;

    public static function run(string $useCaseName, string $baseNamespace, string $basePath = 'domain'): void
    {
        (new MakeUseCase())->handle($useCaseName, $baseNamespace, $basePath);
    }

    private function handle(string $useCaseName, string $baseNamespace, string $basePath): void
    {
        $this->useCaseName = $useCaseName;
        $this->basePath = $basePath;
        $this->baseNamespace = $baseNamespace;

        $this->createDirectoriesIfNotExists();

        $this->generateUseCaseFiles();
        $this->generateUnitTestFiles();
    }

    private function createDirectoriesIfNotExists(): void
    {
        mkdir($this->useCasePath());
        mkdir($this->unitTestPath());
    }

    private function useCasePath(): string
    {
        return $this->basePath . '\src\UseCases\\' . $this->useCaseName;
    }

    private function unitTestPath(): string
    {
        return $this->basePath . '\tests\Unit\\' . $this->useCaseName;
    }


    private function generateUseCaseFiles(): void
    {
        $stubNames = ['_', '_PresenterInterface', '_Request', '_Response', '_Validator'];

        foreach ($stubNames as $stubName) {
            $this->createFileFromStub($this->useCasePath(), $stubName);
        }
    }

    private function generateUnitTestFiles(): void
    {
        $stubNames = ['_Test', '_ValidationTest', '_Base'];

        foreach ($stubNames as $stubName) {
            $this->createFileFromStub($this->unitTestPath(), $stubName);
        }
    }

    private function createFileFromStub(string $folder, string $stubName): void
    {
        $stubPath = dirname(__FILE__) . '\..\stubs\\' . $stubName . '.stub';
        $content = file_get_contents($stubPath);
        $content = $this->replacePlaceholders($content);

        $fileName = str_replace('_', $this->useCaseName, $stubName);
        $fileName = "{$folder}/$fileName.php";
        file_put_contents($fileName, $content);
    }

    private function replacePlaceholders(string $content): string
    {
        $placeholders = [
            '{{ namespace }}' => $this->baseNamespace . "\\Domain\\UseCases\\" . $this->useCaseName,
            '{{ testNamespace }}' => $this->baseNamespace . "\\Tests\\Unit\\" . $this->useCaseName,
            '{{ useCaseName }}' => $this->useCaseName
        ];

        foreach ($placeholders as $placeholder => $replacement) {
            $content = str_replace($placeholder, $replacement, $content);
        }

        return $content;
    }
}
