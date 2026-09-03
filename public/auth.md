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