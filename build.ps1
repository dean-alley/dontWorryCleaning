# ============================================
# BUILD WORDPRESS THEME - DON'T WORRY CLEANING
# ============================================

$ErrorActionPreference = "Stop"
Add-Type -AssemblyName System.IO.Compression.FileSystem

# Configuration
$themeName = "dontworrycleaning"
$distDir = "dist"
$tempDir = Join-Path $distDir "temp"
$outputZip = Join-Path $distDir "$themeName`_v1.zip"

Write-Host "========================================" -ForegroundColor Cyan
Write-Host "  BUILDING THEME: Don't Worry Cleaning" -ForegroundColor Cyan
Write-Host "  Folder: $themeName" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan

# 1. Clean build directories
Write-Host "[1/4] Cleaning build directories..." -ForegroundColor Yellow
if (Test-Path $tempDir) { Remove-Item -Path $tempDir -Recurse -Force }

# 2. Create Temp Structure (Folder-in-Zip Standard)
Write-Host "[2/4] Assembling theme files..." -ForegroundColor Yellow
$themeBuildPath = Join-Path $tempDir $themeName
New-Item -ItemType Directory -Path $themeBuildPath -Force | Out-Null

# Files to include in the theme ZIP
$include = @(
    "*.php",
    "style.css",
    "screenshot.png",
    "assets",
    "template-parts",
    "inc",
    "README.md"
)

# Files/Folders to exclude
$exclude = @(
    ".git",
    ".github",
    ".vscode",
    ".idea",
    "_archive",
    "dist",
    "node_modules",
    "build.ps1",
    "dev.ps1",
    "*.zip",
    "*.rar",
    "*.tar",
    "*.gz",
    "temp-*",
    "tests",
    "ftp-config.json",
    "preview.html",
    "scripts"
)

foreach ($item in $include) {
    if (Test-Path $item) {
        Copy-Item -Path $item -Destination $themeBuildPath -Recurse -Force
        Write-Host "  + Added: $item" -ForegroundColor Green
    }
}

# 3. Remove excluded items from temp build
Write-Host "[3/4] Cleaning excluded files..." -ForegroundColor Yellow
foreach ($ex in $exclude) {
    $pathToRemove = Join-Path $themeBuildPath $ex
    if (Test-Path $pathToRemove) {
        Remove-Item -Path $pathToRemove -Recurse -Force
        Write-Host "  - Removed: $ex" -ForegroundColor Gray
    }
}

# 4. Create ZIP (Nested Structure: zip -> dontworrycleaning -> style.css)
Write-Host "[4/4] Creating ZIP package..." -ForegroundColor Yellow
if (Test-Path $outputZip) { Remove-Item $outputZip -Force }

[System.IO.Compression.ZipFile]::CreateFromDirectory($tempDir, $outputZip)

# Validate the ZIP
if (Test-Path $outputZip) {
    $zip = [System.IO.Compression.ZipFile]::OpenRead($outputZip)
    $hasStyleNested = $false

    foreach ($entry in $zip.Entries) {
        $entryName = $entry.FullName.Replace("\", "/")
        if ($entryName -eq "$themeName/style.css") {
            $hasStyleNested = $true
            break
        }
    }
    $zip.Dispose()

    $size = "{0:N2} MB" -f ((Get-Item $outputZip).Length / 1MB)

    if ($hasStyleNested) {
        Write-Host ""
        Write-Host "SUCCESS! Theme build complete." -ForegroundColor Green
        Write-Host "  - Theme: Don't Worry Cleaning" -ForegroundColor Cyan
        Write-Host "  - Size: $size" -ForegroundColor Cyan
        Write-Host "  - Structure: $themeName/style.css verified (NESTED)" -ForegroundColor Green
        Write-Host "  - Output: $outputZip" -ForegroundColor Cyan
        Write-Host ""
        Write-Host "Upload $outputZip to WordPress Admin > Appearance > Themes > Add New > Upload" -ForegroundColor Yellow
        Write-Host ""
    } else {
        Write-Host "WARNING: ZIP created but $themeName/style.css not found!" -ForegroundColor Red
        $zip = [System.IO.Compression.ZipFile]::OpenRead($outputZip)
        $zip.Entries | Select-Object FullName | Select-Object -First 10
        $zip.Dispose()
    }
} else {
    Write-Host "ERROR: ZIP file was not created." -ForegroundColor Red
    exit 1
}

Write-Host "NOTE: Temp build preserved at $tempDir for verification." -ForegroundColor Gray
