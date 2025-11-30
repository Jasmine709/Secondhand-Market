# Secondhand Market

Project Duration: May 2025 – Jun 2025

A full-stack PHP + MySQL web application with scalable AWS cloud deployment.

## Overview

Secondhand Market is a lightweight web application that allows users to post, browse, comment on, and manage second-hand items.
It includes user authentication, item management, image uploads, and a clean modular PHP backend.

This project is deployed on AWS using a production-ready architecture that includes Elastic Beanstalk, EC2 Auto Scaling, Application Load Balancer, RDS MySQL (Multi-AZ), custom AMI, and a custom VPC with multi-AZ public subnets.
The design ensures scalability, high availability, and stable performance.

## Features
### User System
- User registration, login and logout
- Session-based authentication
- Form validation and sanitization

### Marketplace Functions
- Post items with image upload
- Edit and delete listings
- View item details
- Item comment system
- Browse all items

### Backend
- MySQL relational database
- Secure PHP query handling
- File upload processing
- Organized and modular code structure

## AWS Cloud Deployment
- The cloud deployment is based on the following architecture:
<img width="400" alt="image" src="https://github.com/user-attachments/assets/1025da0a-991f-40b2-aa53-529f05789841" />

### Elastic Beanstalk
- Manages application environment, deployment and health monitoring
- Handles provisioning and integrates with EC2, ALB and Auto Scaling
<img width="400" alt="image" src="https://github.com/user-attachments/assets/67905a5a-24d1-4bbd-bc6e-eba1add89af6" />

### EC2 with Custom AMI
- Amazon Linux AMI preinstalled with Apache, PHP, and application files
- Used by the Auto Scaling Group for fast instance creation
<img width="400" alt="image" src="https://github.com/user-attachments/assets/68cab5f2-8659-41ec-a4ad-5fe92ff0d3b4" />

### Auto Scaling Group
- Minimum 2 and maximum 8 EC2 instances
- Scaling triggered by NetworkOut utilization
<img width="400" alt="image" src="https://github.com/user-attachments/assets/9b6e1868-2028-487a-9b24-c35fa1d614e9" />

### Application Load Balancer
- Distributes traffic between EC2 instances
- Performs health checks and removes unhealthy instances

### RDS MySQL (Multi-AZ)
- Managed database with automatic failover
- Provides high availability and backup support
<img width="400" alt="image" src="https://github.com/user-attachments/assets/8ec7acb3-62e9-4528-a9cf-eedad5f84448" />

### Custom VPC
- Two public subnets across two availability zones
- Internet Gateway and routing configuration
- Separate security groups for EC2 and RDS
<img width="400" alt="image" src="https://github.com/user-attachments/assets/fa3083f1-87ed-40d8-96d4-a8f9925d5c5e" />
<img width="400" alt="image" src="https://github.com/user-attachments/assets/aedb8626-cceb-4ff3-addb-d3bbfd97fd35" />

### Email Notifications
- Elastic Beanstalk environment event notifications
- Alerts for server health and deployment status
<img width="400" alt="image" src="https://github.com/user-attachments/assets/6acd07de-ac56-4550-8566-f735ddc0b6cc" />

## Tech Stack
### Frontend
- HTML5
- CSS

### Backend
- PHP 8+
- Apache
- MySQL

### Cloud
- AWS Elastic Beanstalk
- AWS EC2
- AWS RDS (MySQL)
- AWS Auto Scaling
- AWS Application Load Balancer
- AWS AMI
- AWS VPC

## Screenshots
<img width="250" alt="image" src="https://github.com/user-attachments/assets/17e164c1-c14c-4e5f-8844-3db8d6804de9" />
<img width="250" alt="image" src="https://github.com/user-attachments/assets/b81e35de-e4ba-40a2-87a5-07a725cdd212" />
<img width="250" alt="image" src="https://github.com/user-attachments/assets/04153ba1-608a-43d3-9af7-b5db6e322cb1" />
<img width="250" alt="image" src="https://github.com/user-attachments/assets/735f35e0-68a7-4d98-9e2e-62aa904f0a7b" />
