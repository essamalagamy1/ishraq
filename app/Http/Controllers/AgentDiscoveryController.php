<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class AgentDiscoveryController extends Controller
{
    /**
     * API Catalog per RFC 9727
     * Returns application/linkset+json
     */
    public function apiCatalog(): Response
    {
        $data = [
            'linkset' => [
                [
                    'anchor' => 'https://ishraq.tech/api',
                    'service-desc' => [
                        [
                            'href' => 'https://ishraq.tech/openapi.json',
                            'type' => 'application/vnd.oai.openapi+json;version=3.0',
                        ],
                    ],
                    'service-doc' => [
                        [
                            'href' => 'https://ishraq.tech/docs/api',
                            'type' => 'text/html',
                        ],
                    ],
                    'status' => [
                        [
                            'href' => 'https://ishraq.tech/api/health',
                            'type' => 'application/json',
                        ],
                    ],
                ],
            ],
        ];

        return response(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE), 200, [
            'Content-Type' => 'application/linkset+json; charset=utf-8',
            'Access-Control-Allow-Origin' => '*',
        ]);
    }

    /**
     * ARD (Agentic Resource Discovery) Capability Manifest
     * Returns application/json at /.well-known/ai-catalog.json
     */
    public function aiCatalog(): JsonResponse
    {
        $manifest = [
            'specVersion' => '1.0',
            'host' => [
                'displayName' => 'Ishraq Tech',
                'identifier' => 'did:web:ishraq.tech',
            ],
            'entries' => [
                [
                    'identifier' => 'urn:air:ishraq.tech:server:mcp',
                    'displayName' => 'Ishraq MCP Server',
                    'type' => 'application/mcp-server-card+json',
                    'url' => 'https://ishraq.tech/.well-known/mcp/server-card.json',
                    'representativeQueries' => [
                        'what services does Ishraq tech provide',
                        'request a software development project or design from Ishraq',
                        'get case studies and portfolio projects from Ishraq',
                    ],
                ],
                [
                    'identifier' => 'urn:air:ishraq.tech:skill:services',
                    'displayName' => 'Ishraq Agency Services Skill',
                    'type' => 'text/markdown',
                    'url' => 'https://ishraq.tech/.well-known/agent-skills/ishraq-services/SKILL.md',
                    'representativeQueries' => [
                        'what are the web development and mobile app packages at Ishraq',
                        'how to submit a design request to Ishraq tech',
                    ],
                ],
                [
                    'identifier' => 'urn:air:ishraq.tech:api:openapi',
                    'displayName' => 'Ishraq REST API Specification',
                    'type' => 'application/vnd.oai.openapi+json;version=3.0',
                    'url' => 'https://ishraq.tech/openapi.json',
                    'representativeQueries' => [
                        'fetch published articles and blog posts via API',
                        'submit design inquiry or contact form programmatically',
                    ],
                ],
            ],
        ];

        return response()->json($manifest, 200, [
            'Access-Control-Allow-Origin' => '*',
            'Content-Type' => 'application/json; charset=utf-8',
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }

    /**
     * MCP Server Card per SEP-1649 / SEP-2127
     * Returns /.well-known/mcp/server-card.json
     */
    public function mcpServerCard(): JsonResponse
    {
        $card = [
            'serverInfo' => [
                'name' => 'ishraq-mcp-server',
                'title' => 'Ishraq Tech Agent MCP Server',
                'version' => '1.0.0',
                'description' => 'MCP server for Ishraq digital agency - interact with services, portfolio, blog articles, and design inquiries.',
            ],
            'endpoint' => 'https://ishraq.tech/api/mcp',
            'transport' => 'streamable-http',
            'capabilities' => [
                'tools' => [
                    'listChanged' => true,
                ],
                'resources' => [
                    'subscribe' => false,
                    'listChanged' => true,
                ],
                'prompts' => [
                    'listChanged' => true,
                ],
            ],
        ];

        return response()->json($card, 200, [
            'Access-Control-Allow-Origin' => '*',
            'Content-Type' => 'application/json; charset=utf-8',
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }

    /**
     * Agent Skills Discovery Index per Agent Skills Discovery RFC v0.2.0
     * Returns /.well-known/agent-skills/index.json
     */
    public function agentSkillsIndex(): JsonResponse
    {
        $servicesSkill = $this->getSkillContent('ishraq-services');
        $designSkill = $this->getSkillContent('design-request');

        $index = [
            '$schema' => 'https://schemas.agentskills.io/discovery/0.2.0/schema.json',
            'skills' => [
                [
                    'name' => 'ishraq-services',
                    'type' => 'skill-md',
                    'description' => 'Explore Ishraq Tech digital solutions, software engineering, mobile app development, and UI/UX design services.',
                    'url' => 'https://ishraq.tech/.well-known/agent-skills/ishraq-services/SKILL.md',
                    'digest' => 'sha256:' . hash('sha256', $servicesSkill),
                ],
                [
                    'name' => 'design-request',
                    'type' => 'skill-md',
                    'description' => 'Autonomous agent guide to submit project requirements, custom design requests, and quote inquiries to Ishraq Tech.',
                    'url' => 'https://ishraq.tech/.well-known/agent-skills/design-request/SKILL.md',
                    'digest' => 'sha256:' . hash('sha256', $designSkill),
                ],
            ],
        ];

        return response()->json($index, 200, [
            'Access-Control-Allow-Origin' => '*',
            'Content-Type' => 'application/json; charset=utf-8',
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }

    /**
     * Serve individual SKILL.md file
     */
    public function agentSkillFile(string $skill): Response
    {
        $content = $this->getSkillContent($skill);

        return response($content, 200, [
            'Content-Type' => 'text/markdown; charset=utf-8',
            'Access-Control-Allow-Origin' => '*',
        ]);
    }

    /**
     * OAuth Protected Resource Metadata per RFC 9728
     * Returns /.well-known/oauth-protected-resource
     */
    public function oauthProtectedResource(): JsonResponse
    {
        $metadata = [
            'resource' => 'https://ishraq.tech',
            'authorization_servers' => [
                'https://ishraq.tech',
            ],
            'scopes_supported' => [
                'read',
                'write',
                'agent:execute',
            ],
            'bearer_methods_supported' => [
                'header',
            ],
            'resource_documentation' => 'https://ishraq.tech/docs/api',
        ];

        return response()->json($metadata, 200, [
            'Access-Control-Allow-Origin' => '*',
            'Content-Type' => 'application/json; charset=utf-8',
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }

    /**
     * OAuth 2.0 Authorization Server / OpenID Connect Discovery Metadata
     * Returns /.well-known/oauth-authorization-server and /.well-known/openid-configuration
     */
    public function oauthAuthorizationServer(): JsonResponse
    {
        $discovery = [
            'issuer' => 'https://ishraq.tech',
            'authorization_endpoint' => 'https://ishraq.tech/oauth/authorize',
            'token_endpoint' => 'https://ishraq.tech/oauth/token',
            'jwks_uri' => 'https://ishraq.tech/.well-known/jwks.json',
            'response_types_supported' => ['code', 'token'],
            'grant_types_supported' => [
                'authorization_code',
                'client_credentials',
                'urn:ietf:params:oauth:grant-type:token-exchange',
            ],
            'token_endpoint_auth_methods_supported' => [
                'client_secret_basic',
                'client_secret_post',
                'none',
            ],
            'scopes_supported' => [
                'read',
                'write',
                'agent:execute',
            ],
            'agent_auth' => [
                'skill' => 'https://ishraq.tech/auth.md',
                'register_uri' => 'https://ishraq.tech/agent/register',
                'identity_types_supported' => [
                    'identity_assertion',
                    'anonymous',
                ],
                'anonymous' => [
                    'credential_types_supported' => ['bearer'],
                    'claim_uri' => 'https://ishraq.tech/agent/claim',
                ],
                'identity_assertion' => [
                    'assertion_types_supported' => [
                        'urn:ietf:params:oauth:token-type:id-jag',
                        'verified_email',
                    ],
                    'credential_types_supported' => ['bearer'],
                    'claim_uri' => 'https://ishraq.tech/agent/claim',
                    'revocation_uri' => 'https://ishraq.tech/oauth/revoke',
                ],
            ],
            'events_supported' => [
                'https://schemas.openid.net/secevent/oauth/event-type/token-revocation',
            ],
            'revocation_endpoint' => 'https://ishraq.tech/oauth/revoke',
        ];

        return response()->json($discovery, 200, [
            'Access-Control-Allow-Origin' => '*',
            'Content-Type' => 'application/json; charset=utf-8',
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }

    /**
     * JWKS placeholder for OAuth discovery
     */
    public function jwks(): JsonResponse
    {
        return response()->json(['keys' => []], 200, [
            'Access-Control-Allow-Origin' => '*',
            'Content-Type' => 'application/json; charset=utf-8',
        ]);
    }

    /**
     * Auth.md for Agent Registration Discovery
     * Returns /auth.md with required # auth.md heading
     */
    public function authMd(): Response
    {
        $md = <<<'MARKDOWN'
# auth.md - Ishraq Tech Agent Registration & Authentication

Welcome AI agents and autonomous crawlers. Ishraq Tech provides machine-readable discovery and programmatic access for agents.

## Agent Audience
This document is intended for autonomous AI agents, LLM tool executors, and MCP clients interacting with Ishraq Tech services.

## Registration & Provisioning Flow
- Registration Endpoint: https://ishraq.tech/agent/register
- Claim Endpoint: https://ishraq.tech/agent/claim
- Revocation Endpoint: https://ishraq.tech/oauth/revoke
- Token Endpoint: https://ishraq.tech/oauth/token

To register an autonomous agent:
1. Submit agent identity to `POST https://ishraq.tech/agent/register` to receive client credentials.
2. Exchange credentials at `POST https://ishraq.tech/oauth/token` with `grant_type=client_credentials` for an access token.
3. For anonymous agents, request temporary access at `POST https://ishraq.tech/agent/claim`.

## Discovery & Authentication Metadata
- OAuth Protected Resource Metadata: https://ishraq.tech/.well-known/oauth-protected-resource
- OAuth Authorization Server: https://ishraq.tech/.well-known/oauth-authorization-server
- OpenID Configuration: https://ishraq.tech/.well-known/openid-configuration
- API Catalog (RFC 9727): https://ishraq.tech/.well-known/api-catalog
- MCP Server Card: https://ishraq.tech/.well-known/mcp/server-card.json
- Agent Skills Discovery: https://ishraq.tech/.well-known/agent-skills/index.json
- Agent Registration URI: https://ishraq.tech/agent/register

## Supported Registration & Auth Methods
1. Public Read (Anonymous):
   Agents may query public content (articles, services, portfolio) without credentials using standard HTTP GET requests or MCP read tools.
2. Bearer Token Authentication:
   For write actions, agents present a bearer token:
   Authorization: Bearer <token>
3. Identity Assertions:
   Supported assertion types:
   - ID-JAG: urn:ietf:params:oauth:token-type:id-jag
   - Verified Email assertions

## Contact
For agent developer integration inquiries, contact info@ishraq.tech.
MARKDOWN;

        return response($md, 200, [
            'Content-Type' => 'text/markdown; charset=utf-8',
            'Access-Control-Allow-Origin' => '*',
        ]);
    }

    /**
     * A2A Protocol Agent Card per A2A Specification
     * Returns /.well-known/agent-card.json
     */
    public function agentCard(): JsonResponse
    {
        $card = [
            '$schema' => 'https://a2a-protocol.org/schemas/agent-card-v1.json',
            'name' => 'Ishraq Tech Agent',
            'version' => '1.0.0',
            'description' => 'Autonomous digital agency agent for Ishraq Tech - services inquiry, portfolio exploration, and design request management.',
            'url' => 'https://ishraq.tech',
            'supportedInterfaces' => [
                [
                    'url' => 'https://ishraq.tech/api/a2a',
                    'transport' => 'HTTP-JSON',
                    'protocol' => 'a2a-v1',
                ],
            ],
            'capabilities' => [
                'streaming' => false,
                'pushNotifications' => false,
            ],
            'skills' => [
                [
                    'id' => 'services-inquiry',
                    'name' => 'Services Inquiry',
                    'description' => 'Discover and query software engineering, mobile development, and UI/UX design offerings.',
                ],
                [
                    'id' => 'design-request',
                    'name' => 'Submit Design Request',
                    'description' => 'Submit specifications for new web, mobile, or branding projects.',
                ],
            ],
        ];

        return response()->json($card, 200, [
            'Access-Control-Allow-Origin' => '*',
            'Content-Type' => 'application/json; charset=utf-8',
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }

    /**
     * OpenAPI 3.0 specification for Ishraq Tech APIs
     * Returns /openapi.json
     */
    public function openapi(): JsonResponse
    {
        $spec = [
            'openapi' => '3.0.3',
            'info' => [
                'title' => 'Ishraq Tech API',
                'description' => 'Public API for Ishraq Tech agency - articles, portfolio, services, and design inquiries.',
                'version' => '1.0.0',
                'contact' => [
                    'name' => 'Ishraq Tech Support',
                    'url' => 'https://ishraq.tech',
                    'email' => 'info@ishraq.tech',
                ],
            ],
            'servers' => [
                [
                    'url' => 'https://ishraq.tech',
                    'description' => 'Production Server',
                ],
            ],
            'paths' => [
                '/api/health' => [
                    'get' => [
                        'summary' => 'System Health Check',
                        'description' => 'Returns operational status of the service.',
                        'responses' => [
                            '200' => [
                                'description' => 'Healthy',
                                'content' => [
                                    'application/json' => [
                                        'schema' => [
                                            'type' => 'object',
                                            'properties' => [
                                                'status' => ['type' => 'string', 'example' => 'ok'],
                                                'timestamp' => ['type' => 'string'],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                '/api/services' => [
                    'get' => [
                        'summary' => 'List Services',
                        'description' => 'Get all active agency services and offerings.',
                        'responses' => [
                            '200' => [
                                'description' => 'A list of services',
                            ],
                        ],
                    ],
                ],
                '/api/articles' => [
                    'get' => [
                        'summary' => 'List Articles',
                        'description' => 'Get latest blog articles and publications.',
                        'responses' => [
                            '200' => [
                                'description' => 'A list of published articles',
                            ],
                        ],
                    ],
                ],
                '/api/projects' => [
                    'get' => [
                        'summary' => 'List Portfolio Projects',
                        'description' => 'Get case studies and completed client projects.',
                        'responses' => [
                            '200' => [
                                'description' => 'A list of portfolio projects',
                            ],
                        ],
                    ],
                ],
            ],
            'components' => [
                'securitySchemes' => [
                    'OAuth2' => [
                        'type' => 'oauth2',
                        'description' => 'Ishraq Agent OAuth 2.0',
                        'flows' => [
                            'clientCredentials' => [
                                'tokenUrl' => 'https://ishraq.tech/oauth/token',
                                'scopes' => [
                                    'read' => 'Read public data',
                                    'write' => 'Submit inquiries',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];

        return response()->json($spec, 200, [
            'Access-Control-Allow-Origin' => '*',
            'Content-Type' => 'application/vnd.oai.openapi+json; charset=utf-8',
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }

    /**
     * API Health Endpoint
     */
    public function health(): JsonResponse
    {
        return response()->json([
            'status' => 'ok',
            'version' => '1.0.0',
            'timestamp' => now()->toIso8601String(),
            'service' => 'Ishraq Tech Public API',
        ], 200, [
            'Access-Control-Allow-Origin' => '*',
            'Content-Type' => 'application/json; charset=utf-8',
        ]);
    }

    /**
     * API Documentation HTML/Markdown view
     */
    public function docs(): Response
    {
        $html = <<<'HTML'
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ishraq Tech - API Documentation</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; line-height: 1.6; max-width: 800px; margin: 0 auto; padding: 40px 20px; color: #1e293b; background: #f8fafc; }
        h1, h2, h3 { color: #0f172a; }
        code { background: #e2e8f0; padding: 2px 6px; border-radius: 4px; font-size: 0.9em; }
        pre { background: #0f172a; color: #f8fafc; padding: 16px; border-radius: 8px; overflow-x: auto; }
        .card { background: white; border: 1px solid #e2e8f0; border-radius: 8px; padding: 24px; margin-bottom: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
        a { color: #2563eb; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <h1>Ishraq Tech - API & Agent Documentation</h1>
    <p>Welcome to the official developer and AI agent documentation for Ishraq Tech services.</p>

    <div class="card">
        <h2>Discovery Standards</h2>
        <ul>
            <li><strong>OpenAPI Specification:</strong> <a href="/openapi.json"><code>/openapi.json</code></a></li>
            <li><strong>API Catalog (RFC 9727):</strong> <a href="/.well-known/api-catalog"><code>/.well-known/api-catalog</code></a></li>
            <li><strong>ARD Manifest:</strong> <a href="/.well-known/ai-catalog.json"><code>/.well-known/ai-catalog.json</code></a></li>
            <li><strong>MCP Server Card:</strong> <a href="/.well-known/mcp/server-card.json"><code>/.well-known/mcp/server-card.json</code></a></li>
            <li><strong>Agent Skills:</strong> <a href="/.well-known/agent-skills/index.json"><code>/.well-known/agent-skills/index.json</code></a></li>
            <li><strong>Auth.md:</strong> <a href="/auth.md"><code>/auth.md</code></a></li>
            <li><strong>Health Check:</strong> <a href="/api/health"><code>/api/health</code></a></li>
        </ul>
    </div>

    <div class="card">
        <h2>Content Negotiation for Agents</h2>
        <p>AI agents may request any public page formatted as clean Markdown by sending the following HTTP header:</p>
        <pre>Accept: text/markdown</pre>
    </div>
</body>
</html>
HTML;

        return response($html, 200, [
            'Content-Type' => 'text/html; charset=utf-8',
        ]);
    }

    /**
     * Web Bot Auth signatures directory (RFC draft)
     */
    public function botAuthDirectory(): JsonResponse
    {
        return response()->json([
            'directory' => [
                'authority' => 'ishraq.tech',
                'methods_supported' => ['ecdsa-p256-sha256'],
            ],
        ], 200, [
            'Access-Control-Allow-Origin' => '*',
            'Content-Type' => 'application/json; charset=utf-8',
        ]);
    }

    /**
     * Helper to load skill content
     */
    protected function getSkillContent(string $skill): string
    {
        if ($skill === 'ishraq-services') {
            return <<<'MARKDOWN'
# Ishraq Services Skill

This skill allows agents to discover, browse, and present digital solutions offered by Ishraq Tech.

## Services Catalog
- **Web Application Development**: Full-stack web development using modern technologies (Laravel, Vue, React, TailwindCSS, high-performance APIs).
- **Mobile Application Development**: Native and cross-platform mobile apps for iOS and Android using Flutter and React Native.
- **UI/UX Design**: Modern user interface design, user research, wireframing, interactive prototyping, and design systems.
- **Branding & Corporate Identity**: Comprehensive brand strategies, logos, brand guidelines, and visual assets.

## How to inquire
Agents can submit an inquiry or design request directly via `https://ishraq.tech/request-a-design` or via the contact form at `https://ishraq.tech/contact-us`.
MARKDOWN;
        }

        if ($skill === 'design-request') {
            return <<<'MARKDOWN'
# Design Request Skill

This skill guides autonomous agents on how to structure and submit design or software project requirements to Ishraq Tech.

## Required Details
When preparing a project request:
1. **Client Name / Company Name**
2. **Contact Email or Phone / WhatsApp**
3. **Project Type**: Web Application, Mobile App, UI/UX Design, or Brand Identity
4. **Description & Scope**: Brief overview of the business goals, target audience, and key features.
5. **Timeline & Estimated Budget**

## Submission
Navigate to or submit via `POST /request-a-design` or consult `https://ishraq.tech/request-a-design`.
MARKDOWN;
        }

        if ($skill === 'auth') {
            return <<<'MARKDOWN'
# Ishraq Agent Auth Skill

This skill explains how agents register and authenticate with Ishraq Tech APIs.

## Instructions
- For public discovery, no token is required.
- For protected resources, submit client credentials to `POST /oauth/token` to receive an access token.
MARKDOWN;
        }

        return "# {$skill} Skill\n\nSkill documentation for Ishraq Tech.";
    }
}
