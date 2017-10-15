## Description ##

This master thesis concerns the modeling methods of System Dynamics and Simulation using the Anylogic software. <br>
The purpose is to show how to use software to provide answers to supply chain issues, in particular inventory policy. <br>
We developed a supply chain simulation model that connects a retailer, a wholesaler and a factory. Using an optimization experiment we tried to find the optimal inventory policy for specific operating costs. Due to the interaction of the members of a supply chain, it is impossible to find a solution to the above problem without the use of modeling / simulation software. Based on this, we attempted to answer the problem using the Anylogic software.
The supply chain model operates 24 hours a day and consists of four departments: customers, retailer, wholesaler, and factory.<br>
Using modeling and simulation of stock policy in a supply chain, it has become understandable that stock-related decisions are affected by all those involved in the chain.<br>
Our model showed that an agent's stock policy cannot be taken in isolation because it is influenced by other supply chain agents. To solve the above problem, an optimization <br>
experiment was performed, which, considering the experimental stock policies of all agents, calculated the optimal stock policy solution.
Using modeling and simulation have gave us the ability to study and improve our supply chain by providing us with information that we could not otherwise have.<br>
Our model is based on customer-based variables and their orders. The above method was chosen because there were no actual product’s demand data where we could base our simulation model.<br>
Using actual data will add more precision to the model and simulation. This feature can be achieved by linking the model to an ERP database with real-life data. In this way, the result of <br>
the optimization experiment will be even closer to the actual optimal stock policy value than now, where odds are being used.<br>

![Alt text](/Screenshots/topology.png?raw=true "Suply Chain")

## Directories ##

* **Anylogic Project File** directory contains the simulation project file (Anylogic 7.X)
* **Simulator GUI Dashboard** directory contains the files for Web based Simulator Dashboard (PHP-Laravel)
* **Simulator** directory contains the Anylogic simulator output (Java)
* **Simulator Optimization Experiment** directory contains the Anylogic Optimization output (Java)
* **Screenshots** directory conatins screenshots from the project
* **Conference Poster** directory contains the poster which was published in picoBest Conference (Kavala, Greece, 06/10/2017)
<br>




## How to ##

* Put Simulator GUI Dashboard's files into Web Server
* Create a new MySQL database called 'mais' (username: root, password: p@tr10t)
* Import mais.sql dump
* Visit Simulator GUI Dashboard url and logon (manager@mais.gr/man123 or ceo@mais.gr/ceo123)
* Change the values for costs (only with manager's crendentials) 
* Run the Simulator or Simulator Optimization Experiment

## Tested on ##

**OS**: Windows 10 x86_64 <br>
**CPU**: Intel 2 Quad Q6600 (4) @ 2.400GHz <br>
**Memory**: 4085MiB <br>
**Anylogic**: 7.0.2.x64

## Build ##

* Use Anylogic 7.0.2.x64<br>
* Open Anylogic's Project file (Supply Chain.alp)<br>

## Author ##

Batsakidis Athanasios<br>
a.batsakidis@re-think.gr
