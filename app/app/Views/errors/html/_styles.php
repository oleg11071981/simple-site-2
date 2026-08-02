<?php
/**
 * Общие стили страниц ошибок (оранжевая тема сайта).
 */
?>
<link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
<style>
    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
        font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        background: #fff2c2;
        color: #0f172a;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 24px;
        line-height: 1.5;
    }

    .error-page {
        width: 100%;
        max-width: 560px;
        text-align: center;
        background: #ffffff;
        padding: 3rem 2rem;
        border-radius: 1.5rem;
        border: 1px solid #f0c48b;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.02);
    }

    .error-code {
        font-size: 7rem;
        font-weight: 700;
        color: #f90;
        line-height: 1;
        margin-bottom: 1rem;
        letter-spacing: -0.02em;
    }

    .error-title {
        font-size: 1.6rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 0.75rem;
    }

    .error-text {
        font-size: 1rem;
        color: #64748b;
        margin-bottom: 2rem;
        line-height: 1.6;
    }

    .error-actions {
        display: flex;
        gap: 0.75rem;
        justify-content: center;
        flex-wrap: wrap;
    }

    .btn-primary {
        background: #f90;
        color: #ffffff;
        padding: 0.75rem 1.5rem;
        border-radius: 0.75rem;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.95rem;
        transition: opacity 0.2s, transform 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-primary:hover {
        opacity: 0.9;
        transform: translateY(-1px);
    }

    .btn-secondary {
        background: #fff8e7;
        color: #92400e;
        border: 1px solid #f0c48b;
        padding: 0.75rem 1.5rem;
        border-radius: 0.75rem;
        text-decoration: none;
        font-weight: 500;
        font-size: 0.95rem;
        transition: background 0.2s, transform 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-secondary:hover {
        background: #fff2c2;
        transform: translateY(-1px);
    }

    @media (max-width: 768px) {
        .error-page { padding: 2rem 1.25rem; }
        .error-code { font-size: 4.5rem; }
        .error-title { font-size: 1.3rem; }
        .error-actions { flex-direction: column; align-items: center; }
        .btn-primary, .btn-secondary { width: 220px; justify-content: center; }
    }
</style>
